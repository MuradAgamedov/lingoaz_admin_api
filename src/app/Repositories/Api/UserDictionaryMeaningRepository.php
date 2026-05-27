<?php

namespace App\Repositories\Api;

use App\Models\UserDictionaryMeaning;

class UserDictionaryMeaningRepository
{
    protected $model;

    public function __construct(UserDictionaryMeaning $model)
    {
        $this->model = $model;
    }

    public function allForWord(int $userDictionaryId)
    {
        return $this->model
            ->whereHas('dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->where('user_dictionary_id', $userDictionaryId)
            ->with('definitions')
            ->get();
    }

    public function find(int $id)
    {
        return $this->model
            ->whereHas('dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->with('definitions')
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->model
            ->whereHas('dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->findOrFail($id);
        $model->update($data);
        return $model->fresh('definitions');
    }

    public function delete(int $id)
    {
        return $this->model
            ->whereHas('dictionary', fn($q) => $q->where('user_id', auth()->id()))
            ->where('id', $id)
            ->delete();
    }
}
