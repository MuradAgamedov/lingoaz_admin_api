<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dictionary\CreateRequest;
use App\Http\Requests\Dictionary\UpdateRequest;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function __construct(
        protected \App\Services\DictionaryService $dictionaryService
    ) {}
    
    public function index()
    {
        $dictionaries = $this->dictionaryService->paginate(300, ['categories', "user"]);
        return view('pages.dictionary.index', ['dictionaries' => $dictionaries]);
    }
    public function create()
    {
        $categories = \App\Models\DictionaryCategory::all();
        return view('pages.dictionary.create', compact('categories'));
    }
    public function store(CreateRequest $request)
    {
        $this->dictionaryService->create($request->validated());
        return redirect()->route('dictionary.index');
    }


    public function edit(Request $request, $id)
    {
        $dictionary = $this->dictionaryService->find($id);
        $categories = \App\Models\DictionaryCategory::all();
        return view('pages.dictionary.edit', ['id' => $id, 'dictionary' => $dictionary, 'categories' => $categories]);
    }
    
    public function update(UpdateRequest $request, $id)
    {
        $this->dictionaryService->update($id, $request->validated());
        return redirect()->route('dictionary.index');
    }
    
    public function destroy($id)
    {
        $this->dictionaryService->delete($id);
        return redirect()->route('dictionary.index');
    }

    public function deleteAudio(Request $request, $id)
    {
        $this->dictionaryService->deleteAudio($id, $request->audio_url);
        return redirect()->back();
    }
}
