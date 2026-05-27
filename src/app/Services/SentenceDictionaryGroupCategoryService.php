<?php

namespace App\Services;

use App\Repositories\SentenceDictionaryGroupCategoryRepository;

class SentenceDictionaryGroupCategoryService
{
    public function __construct(
        protected SentenceDictionaryGroupCategoryRepository $repository
    ) {}

    public function allForGroup(int $groupId)
    {
        return $this->repository->allForGroup($groupId);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(int $groupId, array $data)
    {
        return $this->repository->create($groupId, $data);
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
