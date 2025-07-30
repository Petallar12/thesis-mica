<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\MatchingController;
// use App\Http\Controllers\AccountUserController;
use App\Http\Controllers\NewUserRegistrationController;
use App\Http\Controllers\OrganStatusController;
use App\Http\Controllers\DonorCardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimezoneController;
Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/donor', [DonorController::class, 'store'])->name('donor.store');
Route::post('/donor/send-verification', [DonorController::class, 'sendVerification']);
Route::post('/donor/verify-code', [DonorController::class, 'verifyCode']);

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
    Route::get('/organ-status', [OrganStatusController::class, 'index'])->name('organ-status.index');
    Route::post('/organ-status/details', [OrganStatusController::class, 'organDetails'])->name('organ-status.details');
    Route::get('/matching', [MatchingController::class, 'index'])->name('matching.index');
});

Route::get('/schedules', [DashboardController::class, 'schedules'])->name('schedules');

Route::get('/donor-card', [DonorCardController::class, 'index'])->name('donor-card.index');
Route::get('/archive', [DonorController::class, 'index_archive'])->name('donors.index_archive');
Route::get('/archive_recipient', [RecipientController::class, 'index_archive'])->name('recipient.index_archive');
Route::get('/donor-card/{donor}/edit', [DonorCardController::class, 'edit'])->name('donor-card.edit');
Route::post('/donor-card/{donor}', [DonorCardController::class, 'update'])->name('donor-card.update');
Route::post('/donors/{donor}/archive', [DonorController::class, 'archive'])->name('donors.archive');
Route::post('/recipients/{recipient}/archive', [RecipientController::class, 'archive'])->name('recipients.archive');
Route::post('/donors/{donor}/set-inside', [DonorController::class, 'setInside'])->name('donors.setInside');
Route::post('/recipients/{recipient}/set-inside', [RecipientController::class, 'setInside'])->name('recipients.setInside');

Route::get('/matching/settings', [MatchingController::class, 'showSettings'])->name('matching.settings');
Route::post('/matching/settings', [MatchingController::class, 'updateSettings'])->name('matching.updateSettings');

// In routes/web.php

Route::post('/donors/archive', function(Request $request) {
    $donorId = $request->input('donor_id');  // Make sure the donor ID is received
    $donor = App\Models\Donor::find($donorId);  // Retrieve the donor by ID

    if ($donor) {
        // Update the donor's register_outside_inside to 'Archive'
        $donor->register_outside_inside = 'Archive';
        $donor->save();  // Save the updated donor

        return response()->json(['success' => true, 'message' => 'Donor archived successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Donor not found.']);
})->name('donors.archive');
Route::get('/timezone', function () {
    echo date_default_timezone_get(); // This should print Asia/Manila
});
Route::get('/timezone', [TimezoneController::class, 'showTimezone']);

require __DIR__.'/auth.php';
