<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserDictionary\CreateRequest;
use App\Http\Requests\Api\UserDictionary\UpdateRequest;
use App\Services\Api\UserDictionaryService;
use App\Http\Resources\UserDictionaryResource;
use App\Helpers\JsonResponse;

class UserDictionaryController extends Controller
{
    protected $service;

    public function __construct(UserDictionaryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->only('user_dictionary_group_id', 'user_dictionary_category_id');
            return JsonResponse::success(UserDictionaryResource::collection(
                $this->service->paginate(50, $filters)
            ));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            return JsonResponse::success(UserDictionaryResource::make(
                $this->service->create($request->validated())
            ));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return JsonResponse::success(UserDictionaryResource::make(
                $this->service->find($id)
            ));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            return JsonResponse::success(UserDictionaryResource::make(
                $this->service->update($id, $request->validated())
            ));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);
        try {
            $this->service->deleteMultiple($request->ids);
            return JsonResponse::success(null);
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function addAudio(Request $request, int $id)
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,m4a,aac,ogg|max:20480',
        ]);
        try {
            return JsonResponse::success(UserDictionaryResource::make(
                $this->service->addAudio($id, $request->file('audio'))
            ));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }

    public function removeAudio(int $id, int $index)
    {
        try {
            return JsonResponse::success(UserDictionaryResource::make(
                $this->service->removeAudio($id, $index)
            ));
        } catch (\Exception $e) {
            return JsonResponse::error($e->getMessage());
        }
    }
}
