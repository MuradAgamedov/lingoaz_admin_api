<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SentenceDictionary\CreateRequest;
use App\Http\Requests\SentenceDictionary\UpdateRequest;
use App\Http\Resources\Api\SentenceDictionaryResource;
use App\Helpers\JsonResponse;
use App\Services\SentenceDictionaryService;
use App\Services\SentenceDictionaryGroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SentenceDictionaryController extends Controller
{
    public function __construct(
        protected SentenceDictionaryService $service,
        protected SentenceDictionaryGroupService $groupService,
    ) {}

    private function authorizeGroup(int $groupId): bool
    {
        return (bool) $this->groupService->findForUser($groupId, auth()->id());
    }

    public function index(Request $request, int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid        = auth()->id();
            $categoryId = $request->integer('category_id') ?: 'all';
            $v          = Cache::get("user_{$uid}_sdg_{$groupId}_entries_v", 0);
            $key        = "user_{$uid}_sdg_{$groupId}_entries_{$categoryId}_v{$v}";

            $entries = Cache::remember($key, 600, fn() =>
                $this->service->allForGroup($groupId, $categoryId === 'all' ? null : (int) $categoryId)
            );
            return JsonResponse::success(SentenceDictionaryResource::collection($entries));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request, int $groupId)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid   = auth()->id();
            $entry = $this->service->create(array_merge($request->validated(), [
                'user_id' => $uid,
            ]));
            Cache::increment("user_{$uid}_sdg_{$groupId}_entries_v");
            return JsonResponse::success(new SentenceDictionaryResource($entry), 'Created', 201);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $groupId, int $id)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid   = auth()->id();
            $entry = $this->service->update($id, $request->validated());
            if (!$entry) return JsonResponse::error('Not found', 404);
            Cache::increment("user_{$uid}_sdg_{$groupId}_entries_v");
            return JsonResponse::success(new SentenceDictionaryResource($entry));
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
            Cache::increment("user_{$uid}_sdg_{$groupId}_entries_v");
            return JsonResponse::success(null, 'Deleted');
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function addAudio(Request $request, int $groupId, int $id)
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,m4a,aac,ogg|max:20480',
        ]);
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid   = auth()->id();
            $entry = $this->service->addAudio($id, $request->file('audio'));
            Cache::increment("user_{$uid}_sdg_{$groupId}_entries_v");
            return JsonResponse::success(new SentenceDictionaryResource($entry));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function removeAudio(int $groupId, int $id, int $index)
    {
        try {
            if (!$this->authorizeGroup($groupId)) return JsonResponse::error('Not found', 404);
            $uid   = auth()->id();
            $entry = $this->service->removeAudio($id, $index);
            Cache::increment("user_{$uid}_sdg_{$groupId}_entries_v");
            return JsonResponse::success(new SentenceDictionaryResource($entry));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
