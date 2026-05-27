<?php

namespace App\Services;

use App\Repositories\DictionaryMeaningRepository;

class DictionaryMeaningService
{
    protected $repository;

    public function __construct(DictionaryMeaningRepository $repository)
    {
        $this->repository = $repository;
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

    public function getByDictionaryId($dictionaryId)
    {
        return $this->repository->getByDictionaryId($dictionaryId);
    }
}
