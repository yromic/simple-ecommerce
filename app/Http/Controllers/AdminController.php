<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalSellers = User::where('is_seller', true)->count();
        $users = User::all(); 

        return view('admin.dashboard', compact('totalUsers', 'totalSellers', 'users'));
    }

    public function destroyUser(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('status', 'User dihapus.');
    }
}
