<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\FoodCategoryController;
use App\Http\Controllers\Admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // region authenticated
    Route::middleware('auth:admin')->group(function () {
        Route::resource('restaurantCategories', RestaurantCategoryController::class);
        Route::resource('foodCategories', FoodCategoryController::class);

        Route::resource('discounts', DiscountController::class);

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::prefix('comments')->controller(CommentController::class)->name('comments.')->group(function (){
            Route::get('/', 'index')->name('index');
            Route::patch('/{comment}/approve', 'approve')->name('approve');
            Route::delete('/{comment}', 'destroy')->name('destroy');
        });
    });
    // endregion
});
