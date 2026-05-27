<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\WordOfDay;
use Illuminate\Http\Request;

class WordOfDayController extends Controller
{
    public function index()
    {
        $words = WordOfDay::with('dictionary')
            ->orderByDesc('date')
            ->paginate(20);

        return view('pages.word-of-day.index', compact('words'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dictionary_id' => 'required|exists:dictionaries,id',
            'date'          => 'required|date',
        ]);

        WordOfDay::updateOrCreate(
            ['date' => $request->date],
            ['dictionary_id' => $request->dictionary_id]
        );

        return back()->with('success', 'Günün sözü uğurla təyin edildi');
    }

    public function destroy($id)
    {
        WordOfDay::findOrFail($id)->delete();
        return back()->with('success', 'Silindi');
    }

    public function search(Request $request)
    {
        $q = $request->get('q', '');

        $results = Dictionary::where('word', 'like', "%{$q}%")
            ->orWhere('translation', 'like', "%{$q}%")
            ->orderBy('word')
            ->limit(15)
            ->get(['id', 'word', 'translation']);

        return response()->json($results);
    }
}
