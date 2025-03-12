<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;

class PostTagCommandController extends Controller {
    public function add(Request $request, Post $post, Tag $tag) {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        } else if ($post->tags->contains($tag)) {
            abort(409);
        }

        return response($post->tags()->attach($tag), 200);
    }
}
