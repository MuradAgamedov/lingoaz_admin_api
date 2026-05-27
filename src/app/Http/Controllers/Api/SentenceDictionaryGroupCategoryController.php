<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SentenceDictionaryGroupCategory\CreateRequest;
use App\Http\Requests\SentenceDictionaryGroupCategory\UpdateRequest;
use App\Http\Resources\Api\SentenceDictionaryGroupCategoryResource;
use App\Helpers\JsonResponse;
use App\Services\SentenceDictionaryGroupCategoryService;
use App\Services\SentenceDictionaryGroupService;

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
            if (!$this->authorizeGroup($groupId)) {
                return JsonResponse::error('Not found', 404);
            }
            $categories = $this->service->allForGroup($groupId);
            return JsonResponse::success(SentenceDictionaryGroupCategoryResource::collection($categories));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request, int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) {
                return JsonResponse::error('Not found', 404);
            }
            $category = $this->service->create($groupId, $request->validated());
            return JsonResponse::success(new SentenceDictionaryGroupCategoryResource($category), 'Created', 201);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) {
                return JsonResponse::error('Not found', 404);
            }
            $category = $this->service->update($id, $request->validated());
            if (!$category) {
                return JsonResponse::error('Not found', 404);
            }
            return JsonResponse::success(new SentenceDictionaryGroupCategoryResource($category));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) {
                return JsonResponse::error('Not found', 404);
            }
            $deleted = $this->service->delete($id);
            if (!$deleted) {
                return JsonResponse::error('Not found', 404);
            }
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
