<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\Auth\AuthController;
use App\Http\Controllers\api\v1\Order\PreOrderController;

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

        Route::group(['controller' => PreOrderController::class], function () {
            Route::get('/pre-orders', 'index')->name('pre-orders');
        });
    });





});

