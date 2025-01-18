<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

// Homepagina met tweets
Route::get('/', [TweetController::class, 'index'])->name('tweets.index');

// Routes voor het dashboard (alleen ingelogde gebruikers)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes voor het plaatsen van tweets
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
});

// Routes voor profielbeheer (alleen ingelogde gebruikers)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authenticatieroutes
require __DIR__ . '/auth.php';
