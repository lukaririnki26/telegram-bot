<?php

use App\Http\Controllers\Site;
use Illuminate\Support\Facades\Route;

/**
 * Site Homepage
 */
// Route::get('/', [Site\HomeController::class, 'index'])->Middleware(\App\Http\Middleware\FrameHeadersMiddleware::class);
Route::get('/', function(){
    return redirect()->route('auth.login');
});

/**
 * Site Posts
 */
Route::prefix('/posts')->group(function () {
    Route::get('/', [Site\PostController::class, 'index'])->name('posts.list');
    Route::get('/{slug}', [Site\PostController::class, 'show'])->name('posts.show');
});

/**
 * Site Page
 */
Route::get('/{slug}', [Site\PageController::class, 'show'])->name('page.show');
Route::prefix('/page')->group(function () {
    Route::get('/', function(){
        abort(404);
    });
    Route::get('/{slug}', [Site\PageController::class, 'show'])->name('page.show');
});
