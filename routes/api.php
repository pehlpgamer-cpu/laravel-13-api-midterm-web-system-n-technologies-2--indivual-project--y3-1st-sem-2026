<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# V1
Route::middleware(['throttle:api'])->group(function() {
    Route::prefix('v1')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');
            Route::post('/logout', 'logout');
        });

        Route::controller(ProductController::class)->group(function() {
            Route::get('product/{id}', 'show')->whereNumber('id');
            Route::get('/products', 'index');
            Route::post('/products', 'store');
            Route::put('/products', 'update');
            Route::delete('/products', 'destroy');
        });

        Route::controller(CategoryController::class)->group(function() {
            Route::get('/category/{id}', 'show');
            Route::get('/categories', 'index');
            Route::post('/categories', 'store');
            Route::put('/categories', 'update');
            Route::delete('/categories', 'destroy');
        });


    });
});



