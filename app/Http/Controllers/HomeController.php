<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Post;

class HomeController extends Controller {
    public function index() {
        Gate::authorize('viewAny', Post::class);

        return view('pages.index', [
            'posts' => Post::viewable()->with('tags')->take(3)->get(),
        ]);
    }
}
