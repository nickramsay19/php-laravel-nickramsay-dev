<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller {
    public function index(Request $request) {
        $validated = $request->validate([
            'tags' => ['sometimes', 'string'],
        ]);

        $tags = explode(',', $request->get('tags')) ?? [];
        $tags = array_filter($tags, function ($tag) {
            return strlen($tag) > 0;
        });

        return view('pages.posts.index', [
            'posts' => Post::with('tags')
                ->when(count($tags) > 0, function ($query) use ($tags) {
                    $query->whereHas('tags', function ($query) use ($tags) {
                        $query->whereIn('tags.name', $tags);
                    });
                })
                ->get(),
            'tags' => $tags,
        ]);
    }

    public function show(?Post $post) {
        return view('pages.posts.show', [
            'post' => $post,
        ]);
    }

    /*public function show(string slug) {
        return view('pages.posts.show', [
            'post' => Post::where('slug', $slug)
            ->when(!Auth::check(), function (Builder $query) {
                $query->whereNotNull('published_at');
            })
            ->first(),
        ]);
    }*/

    public function create() {
        if (Auth::check()) {
            return view('pages.posts.create');
        } else {
            // show the 404 post page
            return view('pages.posts.show', [
                'post' => null,
            ]);
        }
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'tags' => ['required', 'list'],
            'tags.*' => ['string'],
            'publish' => ['boolean']
        ]);

        $publish = $validated['publish'] ?? false;

        $post = Post::factory()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'author_id' => Auth::user()->id,
            'published_at' => $publish ? Carbon::now() : null,
        ]);

        $post->tags()->attach(Tag::whereIn('name', $validated['tags'])->pluck('id'));

        return $post;
    }

    public function destroy(Post $post) {
        $post->tags()->detach();
        return $post->delete();
    }
}