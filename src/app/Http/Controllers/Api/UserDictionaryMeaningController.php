<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserDictionaryMeaning\CreateRequest;
use App\Http\Requests\Api\UserDictionaryMeaning\UpdateRequest;
use App\Services\Api\UserDictionaryMeaningService;
use App\Http\Resources\UserDictionaryMeaningResource;
use App\Helpers\JsonResponse;

class UserDictionaryMeaningController extends Controller
{
    public function __construct(protected UserDictionaryMeaningService $service) {}

    public function index(Request $request)
    {
        try {
            $wordId = (int) $request->query('user_dictionary_id');
            return JsonResponse::success(
                UserDictionaryMeaningResource::collection($this->service->allForWord($wordId))
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
            return JsonResponse::success(UserDictionaryMeaningResource::make($meaning));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            return JsonResponse::success(
                UserDictionaryMeaningResource::make($this->service->update($id, $request->validated()))
            );
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
