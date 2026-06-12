<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'store' => 'nullable|string|max:50',
        ]);

        NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['store' => $request->store]
        );

        return response()->json(['success' => true]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = NewsletterSubscriber::query();

        if ($search) {
            $query->where('email', 'like', "%{$search}%");
        }

        $subscribers = $query->latest()->paginate(30)->withQueryString();
        $total       = NewsletterSubscriber::count();

        return view('pages.subscribers.index', compact('subscribers', 'search', 'total'));
    }

    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Abunəçi silindi.');
    }
}
