<?php

namespace App\Repositories\Api;

use App\Models\UserDictionaryGroup;

class UserDictionaryGroupRepository
{
    protected $model;

    public function __construct(UserDictionaryGroup $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        $data["user_id"] = auth()->user()->id;
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->model
            ->where('user_id', auth()->id())
            ->findOrFail($id);
        $model->update($data);
        return $model->fresh();
    }

    public function delete($id)
    {
        return $this->model
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();
    }

    public function paginate($perPage = 15, $with = [])
    {
        return $this->model
            ->where('user_id', auth()->id())
            ->with($with)
            ->paginate($perPage);
    }
}
