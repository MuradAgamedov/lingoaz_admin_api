<?php

namespace App\Services\Api;

use App\Repositories\Api\UserDictionaryGroupRepository;

class UserDictionaryGroupService
{
    protected $repository;

    public function __construct(UserDictionaryGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($with = [])
    {
        return $this->repository->all($with);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function paginate($perPage = 15, $with = [])
    {
        return $this->repository->paginate($perPage, $with);
    }
}
