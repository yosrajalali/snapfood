<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Seller\AuthSellerController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->group(function () {

    Route::get('/register', [AuthSellerController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [AuthSellerController::class, 'register'])->name('register');

    // region authenticated
    Route::middleware('auth:seller')->group(function () {
        Route::get('/index', [SellerController::class, 'index'])->name('index');
        Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

        Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
        Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');

//        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::post('/orders/{order}/update-status', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    });
    // endregion
});
