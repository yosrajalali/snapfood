<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FoodCategoryController;
use App\Http\Controllers\Admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // region authenticated
    Route::middleware('auth:admin')->group(function () {
        Route::resource('restaurantCategories', RestaurantCategoryController::class);
        Route::resource('foodCategories', FoodCategoryController::class);

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    });
    // endregion
});
