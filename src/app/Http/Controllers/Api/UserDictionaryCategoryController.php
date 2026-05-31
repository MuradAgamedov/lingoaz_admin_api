<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDictionaryCategoryResource;
use App\Helpers\JsonResponse;
use App\Models\UserDictionaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserDictionaryCategoryController extends Controller
{
    public function index()
    {
        try {
            $uid        = auth()->id();
            $data = Cache::remember("user_{$uid}_dict_cats", 600, function() use ($uid) {
                $categories = UserDictionaryCategory::where('user_id', $uid)->get();
                return UserDictionaryCategoryResource::collection($categories)->resolve();
            });
            return JsonResponse::success($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        try {
            $uid      = auth()->id();
            $category = UserDictionaryCategory::create([
                'user_id' => $uid,
                'title'   => $request->title,
            ]);
            Cache::forget("user_{$uid}_dict_cats");
            return JsonResponse::success(UserDictionaryCategoryResource::make($category));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
        $request->validate(['title' => 'required|string|max:255']);
        try {
            $uid      = auth()->id();
            $category = UserDictionaryCategory::where('user_id', $uid)->findOrFail($id);
            $category->update(['title' => $request->title]);
            Cache::forget("user_{$uid}_dict_cats");
            return JsonResponse::success(UserDictionaryCategoryResource::make($category));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $uid = auth()->id();
            UserDictionaryCategory::where('user_id', $uid)->where('id', $id)->delete();
            Cache::forget("user_{$uid}_dict_cats");
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
