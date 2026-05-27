<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{
    public function __construct(protected NoteRepository $repository) {}

    public function allForGroup(int $groupId, int $userId)
    {
        return $this->repository->allForGroup($groupId, $userId);
    }

    public function find(int $id, int $userId)
    {
        return $this->repository->find($id, $userId);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
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
