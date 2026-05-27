<?php

namespace App\Services\Api;

use App\Repositories\Api\UserDictionaryMeaningRepository;

class UserDictionaryMeaningService
{
    protected $repository;

    public function __construct(UserDictionaryMeaningRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allForWord(int $userDictionaryId)
    {
        return $this->repository->allForWord($userDictionaryId);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
