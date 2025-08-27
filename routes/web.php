<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Publieke welkomstpagina
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Beveiligde routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tweet aanmaken — naam MOET 'dashboard.store' zijn voor de tests
    Route::post('/dashboard/tweet', [DashboardController::class, 'store'])->name('dashboard.store');

    // Profiel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth (login, register, wachtwoord, …)
require __DIR__ . '/auth.php';
