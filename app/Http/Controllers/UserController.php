<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::query()->where('is_admin',0)->get();
        
        
        return view('pages.users.index', compact('users'));
    }

    public function create() {
        // $this->authorize('admin');
        $roles=Role::all();
        return view('pages.users.create' , compact('roles'));
    }

    public function store(Request $request) {
        // $this->authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required',
        ]);
        // dd($validated);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user) {
        // $this->authorize(ability: 'admin');
        $user->delete();
        return back();
    }
}
