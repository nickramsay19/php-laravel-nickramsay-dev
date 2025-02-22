<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

//use App\Models\Session;
use App\Models\User;

class SessionController extends Controller {
    public function create() {
        return view('pages.sessions.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            if (Auth::check()) {
                return redirect()->intended(route('home', absolute: false));
            }

            return 'fail';
        }

        return back()->withErrors([
            'name' => 'Incorrect name or password.',
        ])->onlyInput('name');
    }

    public function destroy(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
