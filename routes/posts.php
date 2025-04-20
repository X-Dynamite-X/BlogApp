<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController , UserPostController};

/** gest Roule */
Route::prefix("/")->group(function () {
    Route::get('/', [PostController::class, 'index'])->name("home");
    Route::get('{category:name}', [PostController::class, 'postCatygory'])
        ->name('post.catygory');
    Route::get('{user:name}/posts', [UserPostController::class, 'index'])->name('users.posts');
}); 
Route::prefix('/')->middleware('auth') ->group(function () {
    Route::prefix('/post')->group(function () {
        Route::post('{post}/like', [PostController::class, 'like'])->name('post.like');
        Route::post('{post}/dislike', [PostController::class, 'dislike'])->name('post.dislike');
        Route::get('{post:title}', [PostController::class, 'show'])->name('post.show');
        Route::get("post/create", [PostController::class, 'create'])->name('post.create');
        Route::get("post/edit", [PostController::class, 'edit'])->name('post.edit');
        
    });
});