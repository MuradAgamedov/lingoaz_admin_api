<?php

namespace App\Http\Controllers;

use App\Http\Requests\DictionaryMeaning\CreateRequest;
use App\Http\Requests\DictionaryMeaning\UpdateRequest;
use App\Services\DictionaryMeaningService;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryMeaningController extends Controller
{
    public function __construct(
        protected DictionaryMeaningService $service
    ) {}

    public function index($dictionaryId)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        $meanings = $this->service->getByDictionaryId($dictionaryId);
        return view('pages.dictionary-meaning.index', compact('dictionary', 'meanings'));
    }

    public function create($dictionaryId)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        return view('pages.dictionary-meaning.create', compact('dictionary'));
    }

    public function store(CreateRequest $request, $dictionaryId)
    {
        $data = $request->validated();
        $data['dictionary_id'] = $dictionaryId;
        $this->service->create($data);
        return redirect()->route('dictionary.meaning.index', $dictionaryId);
    }

    public function edit($dictionaryId, $id)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        $meaning = $this->service->find($id);
        return view('pages.dictionary-meaning.edit', compact('dictionary', 'meaning'));
    }

    public function update(UpdateRequest $request, $dictionaryId, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('dictionary.meaning.index', $dictionaryId);
    }

    public function destroy($dictionaryId, $id)
    {
        $this->service->delete($id);
        return redirect()->route('dictionary.meaning.index', $dictionaryId);
    }
}
