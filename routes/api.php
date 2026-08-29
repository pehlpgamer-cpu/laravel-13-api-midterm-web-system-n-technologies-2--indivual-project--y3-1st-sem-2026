<?php

use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// V1
Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/signup', 'signup');
            Route::post('/login', 'login');
            Route::post('/logout', 'logout');
        });

        Route::apiResource('/products', ProductController::class);
        Route::prefix('/products')->controller(ProductController::class)->group(function () {
            Route::get('/{product}/categories', 'showCategories'); // all categories of a specific product
        });

        Route::apiResource('/product_categories', ProductCategoryController::class);
        Route::apiResource('/categories', CategoryController::class);

        Route::apiResource('/inventories', InventoryController::class);
        Route::apiResource('/inventory-items', InventoryController::class);

        Route::apiResource('/users', UserController::class);
        Route::apiResource('/audit-trails', AuditTrailController::class)->except(['destroy', 'update']);
    });
});
