<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Post;

class PostRouteModelBindingServiceProvider extends ServiceProvider {
    public function register(): void {
        
    }

    public function boot(): void {
        Route::bind('post', function (string $slug) {
            return Post::where('slug', $slug)
                ->when(!Auth::check(), function (Builder $query) {
                    $query->whereNotNull('published_at');
                })
                ->first() ?? null;
        });
    }
}
