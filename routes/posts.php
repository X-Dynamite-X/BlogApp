<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::prefix("/")->group(function () {
    Route::get('/', [PostController::class, 'index'])->name("home");
    Route::get('{name}', [PostController::class, 'postCatygory'])
        ->name('post.catygory');

});

Route::prefix('/post')->group(function () {
    Route::post('{post}/like', [PostController::class, 'like'])->name('post.like');
    Route::post('{post}/dislike', [PostController::class, 'dislike'])->name('post.dislike');
    Route::post('{post}/view', [PostController::class, 'incrementView'])->name('post.view');

});