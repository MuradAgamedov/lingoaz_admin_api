<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserDictionaryDefinition\CreateRequest;
use App\Http\Requests\Api\UserDictionaryDefinition\UpdateRequest;
use App\Services\Api\UserDictionaryDefinitionService;
use App\Http\Resources\UserDictionaryDefinitionResource;
use App\Helpers\JsonResponse;

class UserDictionaryDefinitionController extends Controller
{
    public function __construct(protected UserDictionaryDefinitionService $service) {}

    public function store(CreateRequest $request)
    {
        try {
            return JsonResponse::success(
                UserDictionaryDefinitionResource::make($this->service->create($request->validated()))
            );
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            return JsonResponse::success(
                UserDictionaryDefinitionResource::make($this->service->update($id, $request->validated()))
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
