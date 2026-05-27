<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
    public function __construct(protected Note $model) {}

    public function allForGroup(int $groupId, int $userId)
    {
        return $this->model
            ->where('note_group_id', $groupId)
            ->where('user_id', $userId)
            ->orderByDesc('updated_at')
            ->get();
    }

    public function find(int $id, int $userId)
    {
        return $this->model->where('id', $id)->where('user_id', $userId)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, int $userId, array $data)
    {
        $note = $this->model->where('id', $id)->where('user_id', $userId)->first();
        if (!$note) return false;
        $note->update($data);
        return $note;
    }

    public function delete(int $id, int $userId)
    {
        $note = $this->model->where('id', $id)->where('user_id', $userId)->first();
        if (!$note) return false;
        return $note->delete();
    }
}
