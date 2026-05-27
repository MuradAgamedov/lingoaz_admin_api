<?php

namespace App\Repositories;

use App\Models\NoteGroup;

class NoteGroupRepository
{
    public function __construct(protected NoteGroup $model) {}

    public function allForUser(int $userId)
    {
        return $this->model->where('user_id', $userId)->orderBy('title')->get();
    }

    public function findForUser(int $id, int $userId)
    {
        return $this->model->where('id', $id)->where('user_id', $userId)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, int $userId, array $data)
    {
        $group = $this->model->where('id', $id)->where('user_id', $userId)->first();
        if (!$group) return false;
        $group->update($data);
        return $group;
    }

    public function delete(int $id, int $userId)
    {
        $group = $this->model->where('id', $id)->where('user_id', $userId)->first();
        if (!$group) return false;
        return $group->delete();
    }
}
