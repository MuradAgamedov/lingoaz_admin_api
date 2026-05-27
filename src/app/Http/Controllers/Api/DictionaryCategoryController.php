<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DictionaryCategoryResource;
use App\Http\Resources\Api\DictionaryWordResource;
use App\Helpers\JsonResponse;
use App\Models\DictionaryCategory;
use Illuminate\Support\Facades\Cache;

class DictionaryCategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Cache::remember('dict_categories', 3600, fn() =>
                DictionaryCategory::orderBy('title')->get()
            );
            return JsonResponse::success(DictionaryCategoryResource::collection($categories));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function words(int $id)
    {
        try {
            $words = Cache::remember("dict_words_{$id}", 3600, function () use ($id) {
                $category = DictionaryCategory::findOrFail($id);
                return $category->dictionaries()->orderBy('word')->get();
            });
            return JsonResponse::success(DictionaryWordResource::collection($words));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
