<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostRSSFeedController;
use App\Http\Controllers\PostAtomFeedController;
use App\Http\Controllers\PostCommandController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;

use App\Models\Post;

Route::group(['middleware' => 'web', 'guest'], function () {
    Route::controller(HomeController::class)->name('home')->group(function () {
        Route::get('/', 'index');
    });

    Route::controller(SessionController::class)->group(function () {
        Route::post('/login', 'store')->name('sessions.store');
        Route::get('/login', 'create')->name('login');
        Route::get('/logout', 'destroy')->name('logout');
    });

    Route::name('feed')->group(function () {
        Route::get('/feed', PostRSSFeedController::class);
        Route::get('/feed/rss', PostRSSFeedController::class)->name('.rss');
        Route::get('/feed/atom', PostAtomFeedController::class)->name('.atom');
    });

    Route::name('posts')->prefix('/posts')->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('/', 'index');

            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
        });

        Route::prefix('/{post}')->group(function() {
            Route::controller(PostController::class)->group(function () {
                Route::get('/', 'show')->name('.show');

                Route::get('/edit', 'edit')->name('.edit');
                Route::put('/', 'update')->name('.update');
                Route::delete('/', 'destroy')->name('.destroy');
            });

            Route::controller(PostCommandController::class)->name('.commands')->prefix('/commands')->group(function () {
                Route::post('/trash', 'trash')->name('.trash');
                Route::post('/publish', 'publish')->name('.publish');
                Route::post('/unpublish', 'unpublish')->name('.unpublish');
            });
        });
    });

    Route::name('tags')->prefix('/tags')->group(function () {
        Route::controller(TagController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');
        
            Route::prefix('/{tag:name}')->group(function() {
                Route::get('/edit', 'edit')->name('.edit');
                Route::put('/', 'update')->name('.update');
                Route::delete('/', 'destroy')->name('.destroy');
            });
        });
    });

    Route::name('roles')->prefix('/roles')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');

            Route::prefix('/{role:name}')->group(function() {
                Route::get('/', 'show')->name('.show');
                Route::get('/edit', 'edit')->name('.edit');
                Route::put('/', 'update')->name('.update');
                Route::delete('/', 'destroy')->name('.destroy');
            });
        });
    });
});
