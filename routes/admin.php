<?php

use App\Http\Controllers\Admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    Route::resource('restaurantcategories', RestaurantCategoryController::class);

});
