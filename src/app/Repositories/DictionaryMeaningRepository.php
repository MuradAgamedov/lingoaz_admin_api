<?php

namespace App\Repositories;

use App\Models\DictionaryMeaning;

class DictionaryMeaningRepository
{
    protected $model;

    public function __construct(DictionaryMeaning $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->with('definitions')->find($id);
    }

    public function create(array $data)
    {
        $definitions = $data['definitions'] ?? [];
        unset($data['definitions']);

        $meaning = $this->model->create($data);

        foreach ($definitions as $definitionData) {
            $meaning->definitions()->create($definitionData);
        }

        return $meaning;
    }

    public function update($id, array $data)
    {
        $meaning = $this->find($id);
        if (!$meaning) return false;

        $definitions = $data['definitions'] ?? [];
        unset($data['definitions']);

        $meaning->update($data);

        $meaning->definitions()->delete();
        foreach ($definitions as $definitionData) {
            $meaning->definitions()->create($definitionData);
        }

        return $meaning;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getByDictionaryId($dictionaryId)
    {
        return $this->model->where('dictionary_id', $dictionaryId)->with('definitions')->get();
    }
}
