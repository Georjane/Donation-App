<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('donations', DonationController::class)
//     ->only(['index', 'store'])
//     ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::post('campaigns', [CampaignController::class, 'create']);
    Route::get('campaigns', [CampaignController::class, 'index']);
    Route::post('campaigns/{campaign}/donate', [DonationController::class, 'donate']);
    Route::get('donations', [DonationController::class, 'index']);
});

require __DIR__.'/auth.php';
