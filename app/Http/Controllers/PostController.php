<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchPostsRequest;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller {
    public function index(SearchPostsRequest $request) {
        Gate::authorize('viewAny', Post::class);

        $tags = $request->get('tags', []);
        $search = $request->get('search', '');

        return view('pages.posts.index', [
            'posts' => Post::viewable()->with('tags')
                ->when(count($tags) > 0, function ($query) use ($tags) {
                    $query->whereHas('tags', function ($query) use ($tags) {
                        $query->whereIn('tags.name', $tags);
                    });
                })
                ->when(strlen($search) > 0, function ($query) use ($search) {
                    $query->whereRaw('LOWER(title) LIKE LOWER(?)', ["%{$search}%"])
                        ->orWhereHas('tags', function ($query) use ($search) {
                            $query->whereRaw('LOWER(tags.name) LIKE LOWER(?)', ["%{$search}%"]);
                        });
                })
                ->get(),
        ]);
    }

    public function show(?Post $post) {
        Gate::authorize('view', $post);
        return view('pages.posts.show', [
            'post' => $post,
        ]);
    }

    public function create() {
        Gate::authorize('create', Post::class);
        if (Auth::check()) {
            return view('pages.posts.create');
        } else {
            // show the 404 post page (as if user were attempting to read a page with title "create")
            return view('pages.posts.show', [
                'post' => null,
            ]);
        }
    }

    public function store(PostRequest $request) {
        Gate::authorize('create', Post::class);

        $post = Post::factory()->create([
            'title' => $request->title,
            'body' => $request->body,
            'author_id' => Auth::user()->id,
            'published_at' => $request->published ? Carbon::now() : null,
        ]);

        $post->tags()->attach(Tag::whereIn('name', $request['tags'])->pluck('id'));

        return response($post)->header('HX-Redirect', route('posts.show', $post->slug));
    }

    public function edit(Post $post) {
        Gate::authorize('create', $post);
        return view('pages.posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(PostRequest $request, Post $post) {

        // determine the new slug
        $slug = slug($request->title);
        
        $post->update([
            ...$request->safe()->except(['published', 'tags']),
            'slug' => $slug,
            'published_at' => $request->published ? Carbon::now() : null,
        ]);

        // change tags
        $post->tags()->sync(Tag::whereIn('name', $request['tags'])->pluck('id'));

        return response($post)->header('HX-Redirect', route('posts.show', $slug));
    }

    public function destroy(Post $post) {
        $post->tags()->detach();
        return response($post->delete())->header('HX-Redirect', route('posts'));
    }
}