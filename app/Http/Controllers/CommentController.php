<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller {

    public function store(Request $request) {
        $validated = $request->validate([
            'post_id' => ['required', 'integer'],
            'reference_id' => ['present', 'nullable'],
            'body' => ['required'],
        ]);

        $post = Post::findOrFail($validated['post_id']);

        $comment = Comment::create([
            'post_id' => $post->id,
            'reference_id' => $validated['reference_id'],
            'author_id' => Auth::user()->id,
            'body' => $validated['body'],
        ]);

        return response($comment)->header('HX-Redirect', route('posts.show', $post->slug));
    }
}