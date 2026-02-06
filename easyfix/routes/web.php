<?php

use App\Http\Controllers\CustomerJobController;
use App\Http\Controllers\GuestJobController;
use App\Http\Controllers\JobCommunicationController;
use App\Http\Controllers\ProfessionalApplicationController;
use App\Http\Controllers\QuotePdfController;
use App\Http\Controllers\ProfileAddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderJobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::prefix('professionals')->name('professionals.')->group(function () {
    Route::get('/apply', [ProfessionalApplicationController::class, 'create'])->name('create');
    Route::post('/apply', [ProfessionalApplicationController::class, 'store'])->name('store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/quotes/{quote}/pdf', [QuotePdfController::class, 'show'])->name('quotes.pdf');

    Route::post('/profile/addresses', [ProfileAddressController::class, 'store'])->name('profile.addresses.store');
    Route::patch('/profile/addresses/{address}/default', [ProfileAddressController::class, 'setDefault'])->name('profile.addresses.default');
    Route::delete('/profile/addresses/{address}', [ProfileAddressController::class, 'destroy'])->name('profile.addresses.destroy');
});

// Customer routes (authenticated)
Route::middleware(['auth', 'verified'])->prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', [CustomerJobController::class, 'index'])->name('index');
    Route::get('/request', [CustomerJobController::class, 'create'])->name('create');
    Route::post('/request', [CustomerJobController::class, 'store'])->name('store');
    Route::get('/{jobRequest}', [CustomerJobController::class, 'show'])->name('show');
    Route::post('/{jobRequest}/approve-quote', [CustomerJobController::class, 'approveQuote'])->name('approve-quote');
    Route::post('/{jobRequest}/reject-quote', [CustomerJobController::class, 'rejectQuote'])->name('reject-quote');
    Route::post('/{jobRequest}/messages', [JobCommunicationController::class, 'storeMessage'])->name('messages.store');
    Route::post('/{jobRequest}/update-requests', [JobCommunicationController::class, 'requestUpdate'])->name('update-requests.store');
    Route::post('/{jobRequest}/update-requests/{updateRequest}/respond', [JobCommunicationController::class, 'respondUpdate'])->name('update-requests.respond');
    Route::patch('/{jobRequest}/messages/{messageId}', [JobCommunicationController::class, 'updateMessage'])->name('messages.update');
});

// Provider routes (authenticated + provider role)
Route::middleware(['auth', 'verified'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/', [ProviderJobController::class, 'index'])->name('index');
    Route::get('/jobs/{jobRequest}', [ProviderJobController::class, 'show'])->name('show');
    Route::post('/jobs/{jobRequest}/en-route', [ProviderJobController::class, 'markEnRoute'])->name('en-route');
    Route::post('/jobs/{jobRequest}/in-progress', [ProviderJobController::class, 'markInProgress'])->name('in-progress');
    Route::post('/jobs/{jobRequest}/complete', [ProviderJobController::class, 'markComplete'])->name('complete');
    Route::post('/jobs/{jobRequest}/upload-photo', [ProviderJobController::class, 'uploadPhoto'])->name('upload-photo');
    Route::post('/jobs/{jobRequest}/messages', [JobCommunicationController::class, 'storeMessage'])->name('jobs.messages.store');
    Route::post('/jobs/{jobRequest}/update-requests/{updateRequest}/respond', [JobCommunicationController::class, 'respondUpdate'])->name('jobs.update-requests.respond');
    Route::patch('/jobs/{jobRequest}/messages/{messageId}', [JobCommunicationController::class, 'updateMessage'])->name('jobs.messages.update');
});

// Guest routes (unauthenticated)
Route::prefix('request')->name('guest.')->group(function () {
    Route::get('/', [GuestJobController::class, 'create'])->name('create');
    Route::post('/', [GuestJobController::class, 'store'])->name('store');
});

Route::prefix('track')->name('track.')->group(function () {
    Route::get('/{token}', [GuestJobController::class, 'show'])->name('show');
    Route::post('/{token}/approve-quote', [GuestJobController::class, 'approveQuote'])->name('approve-quote');
    Route::post('/{token}/reject-quote', [GuestJobController::class, 'rejectQuote'])->name('reject-quote');
});

require __DIR__.'/auth.php';
