<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller {
    public function create() {
        Gate::authorize('create', User::class);

        return view('pages.users.create');
    }

    public function store(Request $request) {
        Gate::authorize('create', User::class);

        $validated = $request->validate([
            'email' => ['required'],
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        return response($user)->header('HX-Redirect', route('home'));
    }
}
