<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class PostRSSFeedController extends Controller {
    public function __invoke(Request $request) {
        Gate::authorize('viewAny', Post::class);

        $request->validate([
            'page' => ['sometimes', 'numeric', 'integer', 'min:1'],
        ]);

        $page = $request->input('page', 1);

        return response()
            ->view('feeds.rss', [
                'posts' => Post::viewable()->with('tags')
                    ->whereNotNull('published_at')
                    ->orderBy('created_at', 'desc')
                    ->paginate(3, ['*'], 'page', $page),
            ], 200)
            ->header('Content-Type', 'text/xml;charset=UTF-8');
    }
}