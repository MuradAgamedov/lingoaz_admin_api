<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteGroup\Note\CreateRequest;
use App\Http\Requests\NoteGroup\Note\UpdateRequest;
use App\Http\Resources\Api\NoteResource;
use App\Helpers\JsonResponse;
use App\Services\NoteService;
use App\Services\NoteGroupService;
use Illuminate\Support\Facades\Cache;

class NoteController extends Controller
{
    public function __construct(
        protected NoteService $service,
        protected NoteGroupService $groupService,
    ) {}

    private function authorizeGroup(int $groupId): bool
    {
        return (bool) $this->groupService->findForUser($groupId, auth()->id());
    }

    public function index(int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid   = auth()->id();
            $notes = Cache::remember("user_{$uid}_notes_{$groupId}", 600, fn() =>
                $this->service->allForGroup($groupId, $uid)
            );
            return JsonResponse::success(NoteResource::collection($notes));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request, int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid  = auth()->id();
            $note = $this->service->create(array_merge($request->validated(), [
                'user_id'       => $uid,
                'note_group_id' => $groupId,
            ]));
            Cache::forget("user_{$uid}_notes_{$groupId}");
            return JsonResponse::success(new NoteResource($note), 'Created', 201);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid  = auth()->id();
            $note = $this->service->update($id, $uid, $request->validated());
            if (!$note) return JsonResponse::error('Not found', 404);
            Cache::forget("user_{$uid}_notes_{$groupId}");
            return JsonResponse::success(new NoteResource($note));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid     = auth()->id();
            $deleted = $this->service->delete($id, $uid);
            if (!$deleted) return JsonResponse::error('Not found', 404);
            Cache::forget("user_{$uid}_notes_{$groupId}");
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
