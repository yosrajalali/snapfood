<?php


use App\Http\Controllers\Buyer\AddressController;
use App\Http\Controllers\Buyer\AuthController;
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
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::post('/{address}', 'setCurrent')->name('set_current');
            });

        Route::patch('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    });
    //endregion
});
