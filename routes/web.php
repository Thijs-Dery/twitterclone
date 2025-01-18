<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

// Homepagina met tweets
Route::get('/', [TweetController::class, 'index'])->name('tweets.index');

// Dashboard (voor ingelogde gebruikers)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes voor het plaatsen van tweets (alleen ingelogde gebruikers)
Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth')->name('tweets.store');

// Routes voor profielbeheer
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authenticatieroutes
require __DIR__.'/auth.php';
