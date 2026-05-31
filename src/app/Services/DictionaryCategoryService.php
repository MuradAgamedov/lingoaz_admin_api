<?php

namespace App\Services;

use App\Repositories\DictionaryCategoryRepository;

class DictionaryCategoryService
{
    protected $repository;

    public function __construct(DictionaryCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
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

    public function paginate($perPage = 15, $search = null)
    {
        return $this->repository->paginate($perPage, $search);
    }

    public function bulkDelete(array $ids)
    {
        return $this->repository->bulkDelete($ids);
    }
}
