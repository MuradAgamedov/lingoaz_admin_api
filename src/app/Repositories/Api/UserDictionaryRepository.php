<?php

namespace App\Repositories\Api;

use App\Models\UserDictionary;
use App\Models\UserDictionaryCategory;
use Database\Seeders\UserDictionaryCategorySeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserDictionaryRepository
{
    protected $model;

    public function __construct(UserDictionary $model)
    {
        $this->model = $model;
    }

    public function all(array $filters = [])
    {
        $query = $this->model->where('user_id', auth()->id())->with('categories');
        if (!empty($filters['user_dictionary_group_id'])) {
            $query->where('user_dictionary_group_id', $filters['user_dictionary_group_id']);
        }
        if (!empty($filters['user_dictionary_category_id'])) {
            $query->whereHas('categories', fn($q) =>
                $q->where('user_dictionary_categories.id', $filters['user_dictionary_category_id'])
            );
        }
        return $query->latest()->get();
    }

    public function find($id)
    {
        return $this->model->where('user_id', auth()->id())->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $userId = auth()->id();
            $data['user_id'] = $userId;
            unset($data['audio_urls']);

            $word = $this->model->create($data);

            $default = UserDictionaryCategory::firstOrCreate([
                'user_id' => $userId,
                'title'   => UserDictionaryCategorySeeder::DEFAULT_CATEGORY,
            ]);

            $word->categories()->attach($default->id);

            return $word;
        });
    }

    public function update($id, array $data)
    {
        $model = $this->model->where('user_id', auth()->id())->findOrFail($id);
        unset($data['audio_urls']);
        $model->update($data);
        return $model->fresh();
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $word = $this->model->where('user_id', auth()->id())->findOrFail($id);

            $categoryIds = $word->categories()->pluck('user_dictionary_categories.id');

            $word->delete();

            $this->cleanupEmptyCategories($categoryIds->all());

            return true;
        });
    }

    public function deleteMultiple(array $ids): void
    {
        DB::transaction(function () use ($ids) {
            $userId = auth()->id();

            $words = $this->model
                ->where('user_id', $userId)
                ->whereIn('id', $ids)
                ->with('categories')
                ->get();

            $categoryIds = $words
                ->flatMap(fn($w) => $w->categories->pluck('id'))
                ->unique()
                ->values()
                ->all();

            $this->model->where('user_id', $userId)->whereIn('id', $ids)->delete();

            $this->cleanupEmptyCategories($categoryIds);
        });
    }

    private function cleanupEmptyCategories(array $categoryIds): void
    {
        if (empty($categoryIds)) return;

        UserDictionaryCategory::whereIn('id', $categoryIds)
            ->whereDoesntHave('dictionaries')
            ->where('title', '!=', UserDictionaryCategorySeeder::DEFAULT_CATEGORY)
            ->delete();
    }

    public function paginate($perPage = 50, array $filters = [])
    {
        $query = $this->model->where('user_id', auth()->id())->with('categories');
        if (!empty($filters['user_dictionary_group_id'])) {
            $query->where('user_dictionary_group_id', $filters['user_dictionary_group_id']);
        }
        if (!empty($filters['user_dictionary_category_id'])) {
            $query->whereHas('categories', fn($q) =>
                $q->where('user_dictionary_categories.id', $filters['user_dictionary_category_id'])
            );
        }
        return $query->latest()->paginate($perPage);
    }

    public function addAudio(int $id, $file)
    {
        $model = $this->model->where('user_id', auth()->id())->findOrFail($id);
        $path  = $file->store('audio', 'public');
        $urls  = $model->audio_urls ?? [];
        $urls[] = $path;
        $model->update(['audio_urls' => $urls]);
        return $model->fresh();
    }

    public function removeAudio(int $id, int $index)
    {
        $model = $this->model->where('user_id', auth()->id())->findOrFail($id);
        $urls  = $model->audio_urls ?? [];
        if (isset($urls[$index])) {
            Storage::disk('public')->delete($urls[$index]);
            array_splice($urls, $index, 1);
            $model->update(['audio_urls' => $urls]);
        }
        return $model->fresh();
    }
}
