<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
