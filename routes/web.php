<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommandController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

use App\Models\Post;

//Route::post('/posts/{post}/commands/publish', [PostCommandController::class, 'publish'])->name('posts.commands.publish');

Route::group(['middleware' => 'web', 'guest'], function () {
    Route::controller(HomeController::class)->name('home')->group(function () {
        Route::get('/', 'index');
    });
    
    Route::name('posts')->prefix('/posts')->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('/', 'index');

            Route::middleware('auth')->group(function () {
                Route::get('/create', 'create')->name('.create');
                Route::post('/', 'store')->name('.store');
            });
        });

        //Route::get('/{slug}', [PostController::class, 'show'])->name('.show');

        Route::prefix('/{post}')->group(function() {
            Route::controller(PostController::class)->group(function () {
                
                Route::get('/', 'show')->name('.show');
                
                Route::middleware('auth')->group(function () {
                    //Route::get('/edit', 'edit')->name('.edit');
                    //Route::put('/', 'update')->name('.update');
                    Route::delete('/', 'destroy')->name('.destroy');
                });
            });

            Route::controller(PostCommandController::class)->name('.commands')->prefix('/commands')->group(function () {
                Route::post('/trash', 'trash')->name('.trash');
                Route::post('/publish', 'publish')->name('.publish');
                Route::post('/unpublish', 'unpublish')->name('.unpublish');
            });
        });
    });
    
    
    Route::controller(SessionController::class)->group(function () {
        Route::post('/login', 'store')->name('sessions.store');
        Route::get('/login', 'create')->name('login');
        Route::get('/logout', 'destroy')->name('logout');
    });
});