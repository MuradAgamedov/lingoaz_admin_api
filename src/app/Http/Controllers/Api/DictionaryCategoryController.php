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
            $data = Cache::remember('dict_categories', 3600, function() {
                $categories = DictionaryCategory::orderBy('title')->get();
                return DictionaryCategoryResource::collection($categories)->resolve();
            });
            return JsonResponse::success($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function words(int $id)
    {
        try {
            $data = Cache::remember("dict_words_{$id}", 3600, function () use ($id) {
                $category = DictionaryCategory::findOrFail($id);
                $words = $category->dictionaries()->orderBy('word')->get();
                return DictionaryWordResource::collection($words)->resolve();
            });
            return JsonResponse::success($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
