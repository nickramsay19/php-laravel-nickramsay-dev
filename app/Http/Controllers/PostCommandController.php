<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Tag;

class PostCommandController extends Controller {
    public function destroy(Request $request, Post $post) {
        Gate::authorize('delete', $post);
        return response($post->destroy(), 200);
    }

    public function list(Request $request, Post $post) {
        Gate::authorize('update', $post);
        return response($post->update([
            'is_listed' => true,
        ]), 200);
    }

    public function unlist(Request $request, Post $post) {
        Gate::authorize('update', $post);
        return response($post->update([
            'is_listed' => false,
        ]), 200);
    }

    public function publish(Request $request, Post $post) {
        Gate::authorize('update', $post);
        return response($post->publish(), 200);
    }

    public function unpublish(Request $request, Post $post) {
        Gate::authorize('update', $post);
        return response($post->unpublish(), 200);
    }
}