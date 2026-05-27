<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteGroup\CreateRequest;
use App\Http\Requests\NoteGroup\UpdateRequest;
use App\Http\Resources\Api\NoteGroupResource;
use App\Helpers\JsonResponse;
use App\Services\NoteGroupService;
use Illuminate\Support\Facades\Cache;

class NoteGroupController extends Controller
{
    public function __construct(protected NoteGroupService $service) {}

    public function index()
    {
        try {
            $uid    = auth()->id();
            $groups = Cache::remember("user_{$uid}_note_groups", 600, fn() =>
                $this->service->allForUser($uid)
            );
            return JsonResponse::success(NoteGroupResource::collection($groups));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $uid   = auth()->id();
            $group = $this->service->create($uid, $request->validated());
            Cache::forget("user_{$uid}_note_groups");
            return JsonResponse::success(new NoteGroupResource($group), 'Created', 201);
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
            Cache::forget("user_{$uid}_note_groups");
            return JsonResponse::success(new NoteGroupResource($group));
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
            Cache::forget("user_{$uid}_note_groups");
            Cache::forget("user_{$uid}_notes_{$id}");
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
