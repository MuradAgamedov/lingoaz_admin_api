<?php

namespace App\Repositories\Api;

use App\Models\UserDictionaryDefinition;

class UserDictionaryDefinitionRepository
{
    protected $model;

    public function __construct(UserDictionaryDefinition $model)
    {
        $this->model = $model;
    }

    public function find(int $id)
    {
        return $this->model
            ->whereHas('meaning.dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->model
            ->whereHas('meaning.dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->findOrFail($id);
        $model->update($data);
        return $model->fresh();
    }

    public function delete(int $id)
    {
        return $this->model
            ->whereHas('meaning.dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->where('id', $id)
            ->delete();
    }
}
