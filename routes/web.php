<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('registrations.index');
});

// Registration Resource Routes
Route::resource('registrations', RegistrationController::class);

// Additional route: Print / Preview
Route::get('registrations/{registration}/print', [RegistrationController::class, 'print'])
    ->name('registrations.print');
