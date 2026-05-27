<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\JsonResponse;
use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use App\Models\UserDictionary;
use App\Models\UserDictionaryCategory;
use App\Models\UserDictionaryGroup;
use Database\Seeders\UserDictionaryCategorySeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DictionaryImportController extends Controller
{
    public function importWord(Request $request, int $categoryId, int $wordId)
    {
        $request->validate([
            'user_dictionary_group_id' => 'required|exists:user_dictionary_groups,id',
        ]);

        try {
            $category = DictionaryCategory::findOrFail($categoryId);
            $word     = Dictionary::findOrFail($wordId);

            DB::transaction(function () use ($category, $word, $request, $categoryId, $wordId) {
                $userCategory = $this->matchingUserCategory($category->title);
                $userWord     = $this->findOrCreateWord($word, $request->user_dictionary_group_id);
                $userWord->categories()->syncWithoutDetaching([$userCategory->id]);

                $uid = auth()->id();
                Cache::forget("user_{$uid}_word_group_{$categoryId}_{$wordId}");
                Cache::increment("user_{$uid}_dicts_v");
            });

            return JsonResponse::success(['message' => 'Söz lüğətinizə əlavə edildi']);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function importAll(Request $request, int $categoryId)
    {
        $request->validate([
            'user_dictionary_group_id' => 'required|exists:user_dictionary_groups,id',
        ]);

        try {
            $category = DictionaryCategory::with('dictionaries')->findOrFail($categoryId);

            DB::transaction(function () use ($category, $request) {
                $userCategory = $this->matchingUserCategory($category->title);

                foreach ($category->dictionaries as $word) {
                    $userWord = $this->findOrCreateWord($word, $request->user_dictionary_group_id);
                    $userWord->categories()->syncWithoutDetaching([$userCategory->id]);
                }

                $uid = auth()->id();
                Cache::increment("user_{$uid}_dicts_v");
            });

            return JsonResponse::success([
                'message' => "{$category->title} kateqoriyasının bütün sözləri əlavə edildi",
            ]);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function removeWord(int $categoryId, int $wordId)
    {
        try {
            $dict     = Dictionary::findOrFail($wordId);
            $userWord = UserDictionary::where('user_id', auth()->id())
                ->where('word', $dict->word)
                ->first();

            if (!$userWord) {
                return JsonResponse::success(['message' => 'Söz tapılmadı']);
            }

            DB::transaction(function () use ($userWord) {
                $categoryIds = $userWord->categories()
                    ->pluck('user_dictionary_categories.id');

                $userWord->delete();

                if ($categoryIds->isNotEmpty()) {
                    UserDictionaryCategory::whereIn('id', $categoryIds)
                        ->whereDoesntHave('dictionaries')
                        ->where('title', '!=', UserDictionaryCategorySeeder::DEFAULT_CATEGORY)
                        ->delete();
                }

                $uid = auth()->id();
                Cache::increment("user_{$uid}_dicts_v");
            });

            return JsonResponse::success(['message' => 'Söz lüğətinizdən silindi']);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function wordGroup(int $categoryId, int $wordId)
    {
        $uid    = auth()->id();
        $result = Cache::remember("user_{$uid}_word_group_{$categoryId}_{$wordId}", 600, function () use ($wordId) {
            $dict     = Dictionary::findOrFail($wordId);
            $userWord = UserDictionary::where('user_id', auth()->id())
                ->where('word', $dict->word)
                ->first();
            return ['group_id' => $userWord?->user_dictionary_group_id];
        });

        return JsonResponse::success($result);
    }

    private function matchingUserCategory(string $title): UserDictionaryCategory
    {
        return UserDictionaryCategory::firstOrCreate([
            'user_id' => auth()->id(),
            'title'   => $title,
        ]);
    }

    private function findOrCreateWord(Dictionary $dict, int $groupId): UserDictionary
    {
        return UserDictionary::firstOrCreate(
            ['user_id' => auth()->id(), 'word' => $dict->word],
            [
                'translation'              => $dict->translation,
                'user_dictionary_group_id' => $groupId,
            ]
        );
    }
}
