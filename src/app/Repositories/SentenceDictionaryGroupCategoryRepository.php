<?php

namespace App\Repositories;

use App\Models\SentenceDictionaryGroupCategory;

class SentenceDictionaryGroupCategoryRepository
{
    protected $model;

    public function __construct(SentenceDictionaryGroupCategory $model)
    {
        $this->model = $model;
    }

    public function allForGroup(int $groupId)
    {
        return $this->model
            ->where('sentence_dictionary_group_id', $groupId)
            ->orderBy('title')
            ->get();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(int $groupId, array $data)
    {
        return $this->model->create(array_merge($data, [
            'sentence_dictionary_group_id' => $groupId,
        ]));
    }

    public function update(int $id, array $data)
    {
        $category = $this->model->find($id);
        if (!$category) {
            return false;
        }
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->model->find($id);
        if ($category) {
            return $category->delete();
        }
        return false;
    }
}
