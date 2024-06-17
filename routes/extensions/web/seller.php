<?php


use App\Http\Controllers\OrderController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Seller\AuthSellerController;
use App\Http\Controllers\Seller\CommentController;
use App\Http\Controllers\Seller\FoodController;
use App\Http\Controllers\Seller\ReportController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->group(function () {

    Route::middleware('guest:seller,admin')->group(function (){
        Route::get('/register', [AuthSellerController::class, 'showRegister'])->name('showRegister');
        Route::post('/register', [AuthSellerController::class, 'register'])->name('register');
    });

    // region authenticated
    Route::middleware('auth:seller')->group(function () {

//        Route::get('/index', [SellerController::class, 'index'])->name('index');
//        Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard')
//            ->middleware('restaurant.complete');

        Route::middleware('restaurant.complete:create')->group(function() {
            Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
            Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
        });
        //Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
        //Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
        Route::put('/restaurant/settings', [RestaurantController::class, 'update'])->name('restaurant.settings.update');


        Route::middleware(['restaurant.complete'])->group(function () {

            Route::get('/restaurant/settings', [RestaurantController::class, 'edit'])->name('restaurant.settings.edit');
            //orders
            Route::post('/orders/{order}/update-status', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');
            Route::get('/archived-orders', [OrderController::class, 'archivedOrders'])->name('archived-orders');
            Route::get('/recentOrders', [OrderController::class, 'recentOrders'])->name('recentOrders');

            //foods
            Route::resource('foods', FoodController::class);
            Route::post('/foods/{id}/toggle-food-party', [FoodController::class, 'toggleFoodParty'])->name('foods.toggle-food-party');

            //comments
            Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
            Route::patch('comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
            Route::post('comments/{id}/deleteRequest', [CommentController::class, 'deleteRequest'])->name('comments.deleteRequest');
            Route::post('comments/{id}/response', [CommentController::class, 'response'])->name('comments.response');

            //reports
            Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
            Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
        });


    });
    // endregion
});
