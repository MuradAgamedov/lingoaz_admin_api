<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDictionaryCategoryResource;
use App\Helpers\JsonResponse;
use App\Models\UserDictionaryCategory;
use Illuminate\Http\Request;

class UserDictionaryCategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = UserDictionaryCategory::where('user_id', auth()->id())->get();
            return JsonResponse::success(UserDictionaryCategoryResource::collection($categories));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        try {
            $category = UserDictionaryCategory::create([
                'user_id' => auth()->id(),
                'title'   => $request->title,
            ]);
            return JsonResponse::success(UserDictionaryCategoryResource::make($category));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
        $request->validate(['title' => 'required|string|max:255']);
        try {
            $category = UserDictionaryCategory::where('user_id', auth()->id())->findOrFail($id);
            $category->update(['title' => $request->title]);
            return JsonResponse::success(UserDictionaryCategoryResource::make($category));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            UserDictionaryCategory::where('user_id', auth()->id())->where('id', $id)->delete();
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
