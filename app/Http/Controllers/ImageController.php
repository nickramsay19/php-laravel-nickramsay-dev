<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {
   
    public function show(string $image) {
        //Gate::authorize('view', $image);
        return view('pages.posts.show', [
            'post' => $post,
        ]);
    }

    public function create() {
        //Gate::authorize('create', Post::class);
        return view('pages.images.create');
    }

    public function store(Request $request) {
        //Gate::authorize('create', Post::class);

        $post = Post::factory()->create([
            'title' => $request->safe()->title,
            'body' => $request->safe()->body,
            'author_id' => Auth::user()->id,
            'published_at' => $request->safe()->published ? Carbon::now() : null,
        ]);

        $post->tags()->attach(Tag::whereIn('name', $request->safe()->tags)->pluck('id'));

        return response($post)->header('HX-Redirect', route('posts.show', $post->slug));
    }

    public function destroy(string $image) {
        //Gate::authorize('delete', $post);

        $post->tags()->detach();
        return response($post->delete())->header('HX-Redirect', route('posts'));
    }
}