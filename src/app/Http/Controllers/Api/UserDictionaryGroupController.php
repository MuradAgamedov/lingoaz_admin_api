<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserDictionaryGroup\CreateRequest;
use App\Http\Requests\Api\UserDictionaryGroup\UpdateRequest;
use App\Http\Resources\UserDictionaryGroupResource;
use App\Helpers\JsonResponse;
use App\Services\Api\UserDictionaryGroupService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UserDictionaryGroupController extends Controller
{
    public function __construct(public UserDictionaryGroupService $service)
    {
    }

    public function index()
    {
        try {
            $uid = auth()->id();
            $data = Cache::remember("user_{$uid}_dict_groups", 600, function() {
                $groups = $this->service->all(['user']);
                return UserDictionaryGroupResource::collection($groups)->resolve();
            });
            return JsonResponse::success($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('user-dictionary-groups', 'public');
            }

            $group = $this->service->create($data);
            Cache::forget('user_' . auth()->id() . '_dict_groups');

            return JsonResponse::success(UserDictionaryGroupResource::make($group));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $uid = auth()->id();
            $data = Cache::remember("user_{$uid}_dict_group_{$id}", 600, function() use ($id) {
                $group = $this->service->find($id);
                return UserDictionaryGroupResource::make($group)->resolve();
            });
            return JsonResponse::success($data);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $uid  = auth()->id();

            if ($request->hasFile('image')) {
                $group = $this->service->find($id);
                if ($group && $group->image) {
                    Storage::disk('public')->delete($group->image);
                }
                $data['image'] = $request->file('image')->store('user-dictionary-groups', 'public');
            }

            $group = $this->service->update($id, $data);
            Cache::forget("user_{$uid}_dict_groups");
            Cache::forget("user_{$uid}_dict_group_{$id}");

            return JsonResponse::success(UserDictionaryGroupResource::make($group));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $uid   = auth()->id();
            $group = $this->service->find($id);

            if ($group && $group->image) {
                Storage::disk('public')->delete($group->image);
            }

            $this->service->delete($id);
            Cache::forget("user_{$uid}_dict_groups");
            Cache::forget("user_{$uid}_dict_group_{$id}");

            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
