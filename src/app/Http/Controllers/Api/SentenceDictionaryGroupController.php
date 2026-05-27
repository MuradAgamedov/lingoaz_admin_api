<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SentenceDictionaryGroup\CreateRequest;
use App\Http\Requests\SentenceDictionaryGroup\UpdateRequest;
use App\Http\Resources\Api\SentenceDictionaryGroupResource;
use App\Helpers\JsonResponse;
use App\Services\SentenceDictionaryGroupService;
use Illuminate\Support\Facades\Cache;

class SentenceDictionaryGroupController extends Controller
{
    public function __construct(protected SentenceDictionaryGroupService $service) {}

    public function index()
    {
        try {
            $uid    = auth()->id();
            $groups = Cache::remember("user_{$uid}_sdg", 600, fn() =>
                $this->service->allForUser($uid)
            );
            return JsonResponse::success(SentenceDictionaryGroupResource::collection($groups));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            $uid   = auth()->id();
            $group = Cache::remember("user_{$uid}_sdg_{$id}", 600, fn() =>
                $this->service->findForUser($id, $uid)
            );
            if (!$group) return JsonResponse::error('Not found', 404);
            return JsonResponse::success(new SentenceDictionaryGroupResource($group));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $uid   = auth()->id();
            $group = $this->service->create($uid, $request->validated());
            Cache::forget("user_{$uid}_sdg");
            return JsonResponse::success(new SentenceDictionaryGroupResource($group), 'Created', 201);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $uid   = auth()->id();
            $group = $this->service->update($id, $uid, $request->validated());
            if (!$group) return JsonResponse::error('Not found', 404);
            Cache::forget("user_{$uid}_sdg");
            Cache::forget("user_{$uid}_sdg_{$id}");
            return JsonResponse::success(new SentenceDictionaryGroupResource($group));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $uid     = auth()->id();
            $deleted = $this->service->delete($id, $uid);
            if (!$deleted) return JsonResponse::error('Not found', 404);
            Cache::forget("user_{$uid}_sdg");
            Cache::forget("user_{$uid}_sdg_{$id}");
            Cache::forget("user_{$uid}_sdg_{$id}_cats");
            Cache::increment("user_{$uid}_sdg_{$id}_entries_v");
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
