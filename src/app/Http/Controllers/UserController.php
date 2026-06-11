<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = User::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        
        // Count totals for stats cards
        $totalUsers = User::count();
        $adminUsers = User::where('is_admin', true)->count();
        $regularUsers = $totalUsers - $adminUsers;
        
        return view('pages.users.index', compact('users', 'search', 'totalUsers', 'adminUsers', 'regularUsers'));
    }

    public function toggleAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Do not allow current logged in admin to toggle themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Öz administrator hüquqlarınızı dəyişə bilməzsiniz!');
        }
        
        $user->is_admin = !$user->is_admin;
        $user->save();
        
        return redirect()->back()->with('success', 'İstifadəçi statusu uğurla dəyişdirildi.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Do not allow current logged in user to delete themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Öz hesabınızı silə bilməzsiniz!');
        }
        
        $user->delete();
        
        return redirect()->back()->with('success', 'İstifadəçi uğurla silindi.');
    }
}
