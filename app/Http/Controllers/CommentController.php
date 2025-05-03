<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\User;

class CommentController extends Controller {

    public function show(?Post $comment) {

        $post->load('comments.id');

        return view('components..show', [
            'comment' => $comment,
        ]);
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'parent_post_id' => ['required'],
            'body' => ['required', 'string'],
        ]);

        $parentPost = Post::findOrFail($validated['parent_post_id']);

        $post = Post::factory()->create([
            'parent_post_id' => $parentPost->id,
            'body' => $validated['body'],
            'author_id' => Auth::user()->id,
        ]);


        return response($post);//->header('HX-Redirect', route('posts.show', $parentPost->slug));
    }
}