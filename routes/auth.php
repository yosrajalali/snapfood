<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
// Login Routes
Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
Route::get('/', [AuthController::class, 'showLoginForm'])->name('form');
Route::post('/', [AuthController::class, 'login'])->name('submit');
});

// Registration Routes
Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('form');
Route::post('/{guard}', [AuthController::class, 'register'])->name('submit');
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
