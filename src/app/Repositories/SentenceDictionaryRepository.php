<?php

namespace App\Repositories;

use App\Models\SentenceDictionary;
use Illuminate\Support\Facades\Storage;

class SentenceDictionaryRepository
{
    protected $model;

    public function __construct(SentenceDictionary $model)
    {
        $this->model = $model;
    }

    public function allForGroup(int $groupId, ?int $categoryId = null)
    {
        return $this->model
            ->whereHas('category', fn($q) => $q->where('sentence_dictionary_group_id', $groupId))
            ->where('user_id', auth()->id())
            ->when($categoryId, fn($q) => $q->where('sentence_dictionary_group_category_id', $categoryId))
            ->orderBy('word')
            ->get();
    }

    public function find(int $id)
    {
        return $this->model->where('user_id', auth()->id())->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $entry = $this->model->where('user_id', auth()->id())->find($id);
        if (!$entry) return false;
        $entry->update($data);
        return $entry;
    }

    public function delete(int $id)
    {
        $entry = $this->model->where('user_id', auth()->id())->find($id);
        if (!$entry) return false;
        return $entry->delete();
    }

    public function addAudio(int $id, $file)
    {
        $entry = $this->model->where('user_id', auth()->id())->findOrFail($id);
        $path  = $file->store('sentence-audio', 'public');
        $urls  = $entry->audio_urls ?? [];
        $urls[] = $path;
        $entry->update(['audio_urls' => $urls]);
        return $entry->fresh();
    }

    public function removeAudio(int $id, int $index)
    {
        $entry = $this->model->where('user_id', auth()->id())->findOrFail($id);
        $urls  = $entry->audio_urls ?? [];
        if (isset($urls[$index])) {
            Storage::disk('public')->delete($urls[$index]);
            array_splice($urls, $index, 1);
            $entry->update(['audio_urls' => $urls]);
        }
        return $entry->fresh();
    }
}
