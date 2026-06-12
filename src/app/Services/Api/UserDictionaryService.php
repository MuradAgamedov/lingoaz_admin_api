<?php

namespace App\Services\Api;

use App\Repositories\Api\UserDictionaryRepository;

class UserDictionaryService
{
    protected $repository;

    public function __construct(UserDictionaryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(array $filters = [])
    {
        return $this->repository->all($filters);
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

    public function deleteMultiple(array $ids): void
    {
        $this->repository->deleteMultiple($ids);
    }

    public function paginate($perPage = 50, array $filters = [])
    {
        return $this->repository->paginate($perPage, $filters);
    }

    public function addAudio(int $id, $file)
    {
        return $this->repository->addAudio($id, $file);
    }

    public function removeAudio(int $id, int $index)
    {
        return $this->repository->removeAudio($id, $index);
    }
}
