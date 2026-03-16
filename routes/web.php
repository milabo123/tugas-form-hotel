<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// ── Auth Routes (guest only) ──────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ── Protected Routes (auth required) ─────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('registrations.index');
    });

    // Registration Resource Routes
    Route::resource('registrations', RegistrationController::class);

    // Additional route: Print / Preview
    Route::get('registrations/{registration}/print', [RegistrationController::class, 'print'])
        ->name('registrations.print');
});
