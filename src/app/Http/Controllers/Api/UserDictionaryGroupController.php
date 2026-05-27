<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserDictionaryGroup\CreateRequest;
use App\Http\Requests\Api\UserDictionaryGroup\UpdateRequest;
use App\Http\Resources\UserDictionaryGroupResource;
use App\Helpers\JsonResponse;
use App\Services\Api\UserDictionaryGroupService;
use Illuminate\Support\Facades\Storage;

class UserDictionaryGroupController extends Controller
{
    public function __construct(public UserDictionaryGroupService $service)
    {
    }

    public function index()
    {
        try {
            return JsonResponse::success(UserDictionaryGroupResource::collection($this->service->paginate(50, ['user'])));
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

            return JsonResponse::success(UserDictionaryGroupResource::make($this->service->create($data)));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return JsonResponse::success(UserDictionaryGroupResource::make($this->service->find($id)));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $group = $this->service->find($id);

                if ($group && $group->image) {
                    Storage::disk('public')->delete($group->image);
                }

                $data['image'] = $request->file('image')->store('user-dictionary-groups', 'public');
            }

            return JsonResponse::success(UserDictionaryGroupResource::make($this->service->update($id, $data)));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $group = $this->service->find($id);

            if ($group && $group->image) {
                Storage::disk('public')->delete($group->image);
            }

            return JsonResponse::success($this->service->delete($id));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
