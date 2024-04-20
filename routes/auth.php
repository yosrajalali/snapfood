<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
// Login Routes
Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
Route::get('/', [AuthController::class, 'showLoginForm'])->name('form');
Route::post('/{guard}', [AuthController::class, 'login'])->name('submit');
});

// Registration Routes
Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('seller.form');
Route::post('/{guard}', [AuthController::class, 'register'])->name('seller.submit');
});

// Logout Route
Route::post('/logout/{guard}', [AuthController::class, 'logout'])->name('logout');
});
