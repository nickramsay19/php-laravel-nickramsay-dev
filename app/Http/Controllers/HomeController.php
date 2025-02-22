<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller {
    public function index() {
        return view('pages.index', [
            'posts' => Post::with('tags')->get(),
        ]);
    }
}
