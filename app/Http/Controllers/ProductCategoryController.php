<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductCategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(Product::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request): JsonResource
    {
        return new JsonResource(Product::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory): JsonResource
    {
        return new JsonResource(Product::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory): JsonResource
    {
        return new JsonResource(Product::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory): JsonResource
    {
        return new JsonResource(Product::class);
    }
}
