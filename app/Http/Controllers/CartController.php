<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

final class CartController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart): JsonResource
    {
        return new JsonResource(Cart::class);
    }
}
