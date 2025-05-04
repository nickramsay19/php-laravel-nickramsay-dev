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
use App\Models\User;

class PostController extends Controller {
    public function index(SearchPostsRequest $request) {
        Gate::authorize('viewAny', Post::class);

        $search = $request->get('search', '');
        $sortBys = $request->get('sort_by', []);

        $authorNames = $request->get('authors');
        if ($authorNames !== null) {
            $authorNames = User::whereIn('name', $authorNames)->pluck('name')->toArray();
        }
        
        $posts = Post::with('tags')
                ->whereViewable()
                ->whereIsListed()
                ->whereSlugIn($request->get('slugs'))
                ->whereTitleIn($request->get('titles'))
                ->whereAuthorNameIn($authorNames)
                ->whereCreatedAfter($request->get('created_after'))
                ->wherePublishedAfter($request->get('published_after'))
                ->wherePublished(boolval($request->get('published')))
                ->whereHasTags($request->get('tags', []))
                ->when(strlen($search) > 0, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->whereRaw('LOWER(title) LIKE LOWER(?)', ["%{$search}%"])
                            ->orWhereHas('tags', function ($query) use ($search) {
                                $query->whereRaw('LOWER(tags.name) LIKE LOWER(?)', ["%{$search}%"]);
                            });
                    });
                })
                ->when(count($sortBys) > 0, function ($q) use ($sortBys) {
                    foreach ($sortBys as $sortBy) {
                        $sortByCol = ltrim($sortBy, '-+');
                        $dir = $sortBy[0] == '-' ? 'desc' : 'asc';
                        $q->orderBy($sortByCol, $dir);
                    }
                })
                ->orderBy('created_at', 'desc');

        $totalPages = intval(ceil($posts->count() / $request->perPage()));
        $page = min($request->page(), max($totalPages, 1));

        return view('pages.posts.index', [
            'page' => $page,
            'perPage' => $request->perPage(),
            'totalPages' => $totalPages,
            'posts' => $posts->paginate($request->perPage(), ['*'], 'page', $request->page()),
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
            'title' => $request->safe()->title,
            'body' => $request->safe()->body,
            'author_id' => Auth::user()->id,
            'published_at' => $request->safe()->published ? Carbon::now() : null,
        ]);

        $post->tags()->attach(Tag::whereIn('name', $request->safe()->tags)->pluck('id'));

        return response($post)->header('HX-Redirect', route('posts.show', $post->slug));
    }

    public function edit(Post $post) {
        Gate::authorize('update', $post);
        
        return view('pages.posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(PostRequest $request, Post $post) {
        Gate::authorize('update', $post);

        // calculate new slug if title has changed
        $slug = $post->slug;
        $request->whenHas('title', function ($newTitle) use (&$slug) {
            $slug = slug($newTitle);
        });

        // update the post
        $post->update([
            ...$request->safe()->only(['title', 'body']),
            'slug' => $slug,
        ]);

        // change tags
        $request->whenHas('tags', function ($tags) use ($post) {
            $post->tags()->sync(Tag::whereIn('name', $tags)->pluck('id'));
        });

        return response($post)->header('HX-Redirect', route('posts.show', $slug));
    }

    public function destroy(Post $post) {
        Gate::authorize('delete', $post);

        $post->tags()->detach();
        return response($post->delete())->header('HX-Redirect', route('posts'));
    }
}