<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/donor', [DonorController::class, 'store'])->name('donor.store');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('donors', DonorController::class);
    Route::resource('recipients', RecipientController::class);
});

require __DIR__.'/auth.php';
