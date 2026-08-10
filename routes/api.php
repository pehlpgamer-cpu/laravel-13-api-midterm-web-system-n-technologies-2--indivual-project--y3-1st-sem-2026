<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# V1
Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });


    Route::get('/products/{id?}', [ProductController::class, 'index'])->whereNumber('id');

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products', [ProductController::class, 'update']);
    Route::delete('/products', [ProductController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories', [CategoryController::class, 'update']);
    Route::delete('/categories', [CategoryController::class, 'destroy']);

    // Route::get('/inventory', [InventoryController::class, 'index']);
    // Route::post('/inventory', [InventoryController::class, 'store']);
    // Route::put('/inventory', [InventoryController::class, 'update']);
    // Route::delete('/inventory', [InventoryController::class, 'destroy']);


});



