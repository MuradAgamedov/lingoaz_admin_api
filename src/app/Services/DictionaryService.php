<?php

namespace App\Services;

use App\Repositories\DictionaryRepository;

class DictionaryService
{
    protected $dictionaryRepository;

    public function __construct(DictionaryRepository $dictionaryRepository)
    {
        $this->dictionaryRepository = $dictionaryRepository;
    }

    public function all()
    {
        return $this->dictionaryRepository->all();
    }


    public function find($id)
    {
        return $this->dictionaryRepository->find($id);
    }


    public function create(array $data)
    {
        return $this->dictionaryRepository->create($data);
    }


    public function update($id, array $data)
    {
        return $this->dictionaryRepository->update($id, $data);
    }


    public function delete($id)
    {
        return $this->dictionaryRepository->delete($id);
    }

    public function deleteAudio($id, $audioUrl)
    {
        return $this->dictionaryRepository->deleteAudio($id, $audioUrl);
    }

    public function paginate($perPage = 15, $with = [])
    {
        return $this->dictionaryRepository->paginate($perPage, $with);
    }
}
