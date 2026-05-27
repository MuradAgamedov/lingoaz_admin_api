<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserDictionaryMeaning\CreateRequest;
use App\Http\Requests\Api\UserDictionaryMeaning\UpdateRequest;
use App\Services\Api\UserDictionaryMeaningService;
use App\Http\Resources\UserDictionaryMeaningResource;
use App\Helpers\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserDictionaryMeaningController extends Controller
{
    public function __construct(protected UserDictionaryMeaningService $service) {}

    public function index(Request $request)
    {
        try {
            $wordId   = (int) $request->query('user_dictionary_id');
            $uid      = auth()->id();
            $meanings = Cache::remember("user_{$uid}_word_{$wordId}_meanings", 600, fn() =>
                $this->service->allForWord($wordId)
            );
            return JsonResponse::success(
                UserDictionaryMeaningResource::collection($meanings)
            );
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $meaning = $this->service->create($request->validated());
            $meaning->load('definitions');
            $uid    = auth()->id();
            $wordId = $request->validated()['user_dictionary_id'] ?? 0;
            Cache::forget("user_{$uid}_word_{$wordId}_meanings");
            return JsonResponse::success(UserDictionaryMeaningResource::make($meaning));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $meaning = $this->service->update($id, $request->validated());
            $uid     = auth()->id();
            $wordId  = $meaning->user_dictionary_id;
            Cache::forget("user_{$uid}_word_{$wordId}_meanings");
            return JsonResponse::success(
                UserDictionaryMeaningResource::make($meaning)
            );
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $meaning = $this->service->find($id);
            $uid     = auth()->id();
            $wordId  = $meaning?->user_dictionary_id;
            $this->service->delete($id);
            if ($wordId) Cache::forget("user_{$uid}_word_{$wordId}_meanings");
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
