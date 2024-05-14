<?php


use App\Http\Controllers\Buyer\AddressController;
use App\Http\Controllers\Buyer\AuthController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::prefix('buyer')->name('buyer.')->middleware('force.json')->group(function () {

    Route::middleware('guest:seller,admin,buyer')->group(function () {

        Route::post('/login', [AuthController::class, 'login'])->name('login');

        Route::post('/register', [AuthController::class, 'register'])->name('register');

    });

    //region authenticated
    Route::middleware('auth:buyer')->group(function () {
        Route::prefix('addresses')
            ->name('addresses.')
            ->controller(AddressController::class)
            ->group(function (){
                //address
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::post('/{address}', 'setCurrent')->name('set_current');
            });

        //profile
        Route::patch('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

        //restaurant
        Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
        Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

        Route::get('/restaurants/{restaurant}/foods', [RestaurantController::class, 'getFoods'])->name('restaurant.foods');

        //cart
        Route::post('/carts/add', [CartController::class, 'addToCart'])->name('carts.add');
        Route::get('/carts', [CartController::class, 'index'])->name('carts.index');

    });
    //endregion
});
