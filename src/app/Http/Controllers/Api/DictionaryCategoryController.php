<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DictionaryCategoryResource;
use App\Http\Resources\Api\DictionaryWordResource;
use App\Helpers\JsonResponse;
use App\Models\DictionaryCategory;

class DictionaryCategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = DictionaryCategory::orderBy('title')->get();
            return JsonResponse::success(DictionaryCategoryResource::collection($categories));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function words(int $id)
    {
        try {
            $category = DictionaryCategory::findOrFail($id);
            $words = $category->dictionaries()->orderBy('word')->get();
            return JsonResponse::success(DictionaryWordResource::collection($words));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
