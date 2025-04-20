<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProfileController};

/** gest Roule */
Route::prefix("/")->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name("profile");
    Route::get("/profile/edit", [ProfileController::class, 'edit'])->name("profile.edit");
});