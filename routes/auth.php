<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login');
    Route::get('register', [AdminAuthController::class, 'showRegister'])->name('register.show');
    Route::post('register', [AdminAuthController::class, 'register'])->name('register');

    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    // region authenticated
    Route::middleware('auth:admin')->group(function () {

    });
    // endregion
});
