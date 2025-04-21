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
        Route::get("create", [PostController::class, 'create'])->name('post.create');
        Route::post("store", [PostController::class, 'store'])->name('post.store');
        Route::get("edit/{post:title}", [PostController::class, 'edit'])->name('post.edit');
        Route::put("update/{post}", [PostController::class, 'update'])->name('post.update');
        Route::delete("delete/{post:title}", [PostController::class, 'destroy'])->name('post.destroy');
    });
});