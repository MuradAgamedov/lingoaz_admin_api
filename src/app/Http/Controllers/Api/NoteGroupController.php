<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteGroup\CreateRequest;
use App\Http\Requests\NoteGroup\UpdateRequest;
use App\Http\Resources\Api\NoteGroupResource;
use App\Helpers\JsonResponse;
use App\Services\NoteGroupService;

class NoteGroupController extends Controller
{
    public function __construct(protected NoteGroupService $service) {}

    public function index()
    {
        try {
            $groups = $this->service->allForUser(auth()->id());
            return JsonResponse::success(NoteGroupResource::collection($groups));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $group = $this->service->create(auth()->id(), $request->validated());
            return JsonResponse::success(new NoteGroupResource($group), 'Created', 201);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $group = $this->service->update($id, auth()->id(), $request->validated());
            if (!$group) return JsonResponse::error('Not found', 404);
            return JsonResponse::success(new NoteGroupResource($group));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $deleted = $this->service->delete($id, auth()->id());
            if (!$deleted) return JsonResponse::error('Not found', 404);
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
