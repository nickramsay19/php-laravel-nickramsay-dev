<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Tag;

class PostCommandController extends Controller {
    public function destroy(Request $request, Post $post) {
        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }
        
        return response($post->destroy(), 200);
    }

    public function publish(Request $request, Post $post) {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
        return response($post->publish(), 200);
    }

    public function unpublish(Request $request, Post $post) {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
        return response($post->unpublish(), 200);
    }
}