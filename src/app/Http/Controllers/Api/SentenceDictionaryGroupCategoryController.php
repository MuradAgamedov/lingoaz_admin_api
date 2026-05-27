<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SentenceDictionaryGroupCategory\CreateRequest;
use App\Http\Requests\SentenceDictionaryGroupCategory\UpdateRequest;
use App\Http\Resources\Api\SentenceDictionaryGroupCategoryResource;
use App\Helpers\JsonResponse;
use App\Services\SentenceDictionaryGroupCategoryService;
use App\Services\SentenceDictionaryGroupService;
use Illuminate\Support\Facades\Cache;

class SentenceDictionaryGroupCategoryController extends Controller
{
    public function __construct(
        protected SentenceDictionaryGroupCategoryService $service,
        protected SentenceDictionaryGroupService $groupService,
    ) {}

    private function authorizeGroup(int $groupId): bool
    {
        return (bool) $this->groupService->findForUser($groupId, auth()->id());
    }

    public function index(int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid        = auth()->id();
            $categories = Cache::remember("user_{$uid}_sdg_{$groupId}_cats", 600, fn() =>
                $this->service->allForGroup($groupId)
            );
            return JsonResponse::success(SentenceDictionaryGroupCategoryResource::collection($categories));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request, int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid      = auth()->id();
            $category = $this->service->create($groupId, $request->validated());
            Cache::forget("user_{$uid}_sdg_{$groupId}_cats");
            return JsonResponse::success(new SentenceDictionaryGroupCategoryResource($category), 'Created', 201);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid      = auth()->id();
            $category = $this->service->update($id, $request->validated());
            if (!$category) return JsonResponse::error('Not found', 404);
            Cache::forget("user_{$uid}_sdg_{$groupId}_cats");
            return JsonResponse::success(new SentenceDictionaryGroupCategoryResource($category));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid     = auth()->id();
            $deleted = $this->service->delete($id);
            if (!$deleted) return JsonResponse::error('Not found', 404);
            Cache::forget("user_{$uid}_sdg_{$groupId}_cats");
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
