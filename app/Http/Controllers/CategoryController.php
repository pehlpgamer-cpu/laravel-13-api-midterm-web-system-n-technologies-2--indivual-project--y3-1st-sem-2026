<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(CategoryController::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResource
    {
        return new JsonResource(CategoryController::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource
    {
        return new JsonResource(CategoryController::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResource
    {
        return new JsonResource(CategoryController::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResource
    {
        return new JsonResource(CategoryController::class);
    }
}
