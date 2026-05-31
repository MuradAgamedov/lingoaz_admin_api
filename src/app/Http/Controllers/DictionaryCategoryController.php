<?php

namespace App\Http\Controllers;

use App\Http\Requests\DictionaryCategory\CreateRequest;
use App\Http\Requests\DictionaryCategory\UpdateRequest;
use App\Services\DictionaryCategoryService;
use Illuminate\Http\Request;

class DictionaryCategoryController extends Controller
{
    public function __construct(
        protected DictionaryCategoryService $service
    ) {}

    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->service->paginate(300, $search);
        return view('pages.dictionary-category.index', compact('categories', 'search'));
    }

    public function bulkDelete(Request $request)
    {
        dd(1);
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            $this->service->bulkDelete($ids);
        }
        return redirect()->route('dictionary-category.index');
    }

    public function create()
    {
        return view('pages.dictionary-category.create');
    }

    public function store(CreateRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('dictionary-category.index');
    }

    public function edit($id)
    {
        $category = $this->service->find($id);
        return view('pages.dictionary-category.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('dictionary-category.index');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('dictionary-category.index');
    }
}
