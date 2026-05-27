<?php

namespace App\Services;

use App\Repositories\SentenceDictionaryGroupRepository;

class SentenceDictionaryGroupService
{
    public function __construct(
        protected SentenceDictionaryGroupRepository $repository
    ) {}

    public function allForUser(int $userId)
    {
        return $this->repository->allForUser($userId);
    }

    public function findForUser(int $id, int $userId)
    {
        return $this->repository->findForUser($id, $userId);
    }

    public function create(int $userId, array $data)
    {
        return $this->repository->create(array_merge($data, ['user_id' => $userId]));
    }

    public function update(int $id, int $userId, array $data)
    {
        return $this->repository->update($id, $userId, $data);
    }

    public function delete(int $id, int $userId)
    {
        return $this->repository->delete($id, $userId);
    }
}
