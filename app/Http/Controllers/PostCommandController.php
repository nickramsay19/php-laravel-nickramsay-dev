<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Tag;

class PostCommandController extends Controller {
    public function destroy(Post $post) {
        return response($post->destroy(), 200);
    }

    public function publish(Post $post) {
        return response($post->publish(), 200);
    }

    public function unpublish(Request $request, Post $post) {
        return response($post->unpublish(), 200);
    }
}