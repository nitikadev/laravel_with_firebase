<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login-by-firebase', 'login');
    Route::post('register-by-firebase', 'register');
    Route::middleware('auth.firebase')->group(function () {
        Route::get('test', 'test');
        Route::resource('products', ProductsController::class);
    });
});