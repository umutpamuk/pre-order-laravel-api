<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {

    Route::group(['controller' => AuthController::class], function () {
        Route::post('/auth/register', 'createUser')->name('auth.register');
        Route::post('/auth/login', 'loginUser')->name('auth.login');
    });

    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

        Route::group(['controller' => CartController::class], function () {
            Route::post('/cart/list', 'list')->name('cart.list');
            Route::post('/cart/add', 'add')->name('cart.add');
            Route::post('/cart/remove', 'remove')->name('cart.remove');
            Route::post('/cart/update', 'update')->name('cart.update');
        });

        Route::group(['controller' => PreOrderController::class], function () {
            Route::get('/pre-orders', 'index')->name('pre-orders.index');
            Route::post('/pre-order/approve', 'awaitingToApprove')->name('pre-order.approve');
            Route::post('/pre-order', 'store')->name('pre-order.store');
        });

    });

    Route::group(['controller' => ProductController::class], function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/available', 'available')->name('products.available');
    });
});

