<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;


Route::get('/test', function () {

    return response()->json([
        'message' => 'API UpSize Coffee aktif'
    ]);

});


Route::post('/login', [AuthController::class, 'login']);


Route::post('/payment/callback', [PaymentController::class, 'callback']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/orders', [OrderController::class, 'index']);

});


Route::get('/products', [ProductController::class, 'index']);