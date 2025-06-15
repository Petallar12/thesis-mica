<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientController;
// use App\Http\Controllers\AccountUserController;
use App\Http\Controllers\NewUserRegistrationController;
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

// Commenting out previous role-restricted registration routes
// Route::middleware(['auth', 'can:access-registration'])->group(function () {
//     Route::get('/register-account-user', [AccountUserController::class, 'create'])->name('account-user.create');
//     Route::post('/register-account-user', [AccountUserController::class, 'store'])->name('account-user.store');
// });

// New public routes for user registration
Route::get('/new-user-register', [NewUserRegistrationController::class, 'create'])->name('new-user-register.create');
Route::post('/new-user-register', [NewUserRegistrationController::class, 'store'])->name('new-user-register.store');

// Keep the original /register route for existing functionality or remove if not needed anymore
// Route::get('/register', [RegisteredUserController::class, 'create'])
//     ->middleware('guest')
//     ->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('donors', DonorController::class);
    Route::resource('recipients', RecipientController::class);
});

require __DIR__.'/auth.php';
