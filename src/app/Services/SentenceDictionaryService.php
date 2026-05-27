<?php

namespace App\Services;

use App\Repositories\SentenceDictionaryRepository;

class SentenceDictionaryService
{
    public function __construct(
        protected SentenceDictionaryRepository $repository
    ) {}

    public function allForGroup(int $groupId, ?int $categoryId = null)
    {
        return $this->repository->allForGroup($groupId, $categoryId);
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

    public function addAudio(int $id, $file)
    {
        return $this->repository->addAudio($id, $file);
    }

    public function removeAudio(int $id, int $index)
    {
        return $this->repository->removeAudio($id, $index);
    }
}
