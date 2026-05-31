<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserDictionary\CreateRequest;
use App\Http\Requests\Api\UserDictionary\UpdateRequest;
use App\Services\Api\UserDictionaryService;
use App\Http\Resources\UserDictionaryResource;
use App\Helpers\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserDictionaryController extends Controller
{
    protected $service;

    public function __construct(UserDictionaryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $uid     = auth()->id();
            $filters = $request->only('user_dictionary_group_id', 'user_dictionary_category_id');
            $groupId = $filters['user_dictionary_group_id'] ?? 'all';
            $catId   = $filters['user_dictionary_category_id'] ?? 'all';
            $v       = Cache::get("user_{$uid}_dicts_v", 0);
            $key     = "user_{$uid}_dicts_{$groupId}_{$catId}_v{$v}";

            $data = Cache::remember($key, 600, function() use ($filters) {
                $words = $this->service->paginate(50, $filters);
                return UserDictionaryResource::collection($words)->response()->getData(true);
            });
            return response()->json($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $word = $this->service->create($request->validated());
            Cache::increment("user_" . auth()->id() . "_dicts_v");
            return JsonResponse::success(UserDictionaryResource::make($word));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $uid  = auth()->id();
            $data = Cache::remember("user_{$uid}_dict_{$id}", 600, function() use ($id) {
                $word = $this->service->find($id);
                return UserDictionaryResource::make($word)->resolve();
            });
            return JsonResponse::success($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $uid  = auth()->id();
            $word = $this->service->update($id, $request->validated());
            Cache::increment("user_{$uid}_dicts_v");
            Cache::forget("user_{$uid}_dict_{$id}");
            return JsonResponse::success(UserDictionaryResource::make($word));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $uid = auth()->id();
            $this->service->delete($id);
            Cache::increment("user_{$uid}_dicts_v");
            Cache::forget("user_{$uid}_dict_{$id}");
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);
        try {
            $uid = auth()->id();
            $this->service->deleteMultiple($request->ids);
            Cache::increment("user_{$uid}_dicts_v");
            foreach ($request->ids as $id) {
                Cache::forget("user_{$uid}_dict_{$id}");
            }
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function addAudio(Request $request, int $id)
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,m4a,aac,ogg|max:20480',
        ]);
        try {
            $uid  = auth()->id();
            $word = $this->service->addAudio($id, $request->file('audio'));
            Cache::increment("user_{$uid}_dicts_v");
            Cache::forget("user_{$uid}_dict_{$id}");
            return JsonResponse::success(UserDictionaryResource::make($word));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function removeAudio(int $id, int $index)
    {
        try {
            $uid  = auth()->id();
            $word = $this->service->removeAudio($id, $index);
            Cache::increment("user_{$uid}_dicts_v");
            Cache::forget("user_{$uid}_dict_{$id}");
            return JsonResponse::success(UserDictionaryResource::make($word));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
