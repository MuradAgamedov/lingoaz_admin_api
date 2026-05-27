<?php

namespace App\Repositories;

use App\Models\DictionaryCategory;
use Illuminate\Support\Facades\Storage;

class DictionaryCategoryRepository
{
    protected $model;

    public function __construct(DictionaryCategory $model)
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
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('dictionary-category/images', 'public');
        }
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->model->find($id);
        if (!$category) {
            return false;
        }

        if (isset($data['image']) && $data['image']) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $data['image']->store('dictionary-category/images', 'public');
        } else {
            unset($data['image']);
        }

        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->model->find($id);
        if ($category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            return $category->delete();
        }
        return false;
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
}
