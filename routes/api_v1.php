<?php

// Controllers
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;


// Middlewares
use App\Http\Middleware\Api\V1\RequireBearerToken;
use Illuminate\Support\Facades\Route;

    Route::prefix('auth')->name('auth.')->group(function (): void {
    Route::post('register', [AuthController::class, 'register'])
        ->middleware('throttle:6,1')
        ->name('register');

    Route::post('login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('login');

    Route::post('refresh', [AuthController::class, 'refresh'])
        ->middleware([
            RequireBearerToken::class,
            'throttle:refresh',
        ])
        ->name('refresh');

    Route::middleware([RequireBearerToken::class, 'auth:api',])->group(function (): void {
        Route::get('me', [AuthController::class, 'me'])
            ->name('me');

        Route::post('logout', [AuthController::class, 'logout'])
            ->name('logout');
        });
    });


    Route::apiResource('/products', ProductController::class);
    Route::prefix('/products')->controller(ProductController::class)->group(function ()
    {
        Route::get('/{product}/categories', 'showCategories'); // all categories of a specific product
    });

    // Route::apiResource('/product_categories', ProductCategoryController::class);
    // Route::apiResource('/categories', CategoryController::class);

    // Route::apiResource('/inventories', InventoryController::class);
    // Route::apiResource('/inventory-items', InventoryController::class);

    // Route::apiResource('/users', UserController::class);
    // Route::apiResource('/audit-trails', AuditTrailController::class)->except(['destroy', 'update']);


