<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller {
    public function index() {
        Gate::authorize('viewAny', Tag::class);

        return view('pages.tags.index', [
            'tags' => Tag::all(),
        ]);
    }

    public function create() {
        Gate::authorize('create', Tag::class);

        return view('pages.tags.create');
    }

    public function store(TagRequest $request) {
        Gate::authorize('create', Tag::class);

        return response(Tag::create([
            'name' => $request->safe()->name,
        ]))->header('HX-Redirect', route('tags'));
    } 

    public function edit(Tag $tag) {
        Gate::authorize('update', $tag);

        return view('pages.tags.edit', [
            'tag' => $tag,
        ]);
    }  

    public function update(TagRequest $request, Tag $tag) {
        Gate::authorize('update', $tag);

        return response($tag->update([
            'name' => $request->safe()->name,
        ]))->header('HX-Redirect', route('tags'));
    }

    public function destroy(Tag $tag) {
        Gate::authorize('delete', $tag);

        $tag->posts()->detach();
        return $tag->delete();
    }
}
