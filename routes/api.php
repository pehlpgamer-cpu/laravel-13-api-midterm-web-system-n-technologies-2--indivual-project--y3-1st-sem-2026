<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# V1
Route::middleware(['throttle:api'])->group(function() {
    Route::prefix('v1')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/signup', 'signup');
            Route::post('/login', 'login');
            Route::post('/logout', 'logout');
        });

        Route::controller(ProductController::class)->group(function()
        {
            Route::prefix('/products')->group(function()
            {
                Route::prefix('/{id}')->group(function()
                {
                    Route::get('', 'show');
                    Route::delete('', 'destroy');
                })
                ->whereNumber('id');

                Route::get('', 'index');

                Route::post('', 'store');
                Route::put('', 'update');
            });
        });

        Route::controller(CategoryController::class)->group(function()
        {
            Route::prefix('/categories')->group(function()
            {
                Route::prefix('/{id}')->group(function()
                {
                    Route::get('', 'show');
                    Route::delete('', 'destroy');
                })->whereNumber('id');

                Route::get('', 'index');
                Route::post('', 'store');
                Route::put('', 'update');
            });
        });

        Route::controller(InventoryController::class)->group(function()
        {
            Route::prefix('/inventories')->group(function()
            {
                Route::prefix('/{id}')->group(function()
                {
                    Route::get('', 'show');
                    Route::delete('', 'destroy');
                })->whereNumber('id');

                Route::get('', 'index');
                Route::post('', 'store');
                Route::put('', 'update');
            });
        });


    });
});



