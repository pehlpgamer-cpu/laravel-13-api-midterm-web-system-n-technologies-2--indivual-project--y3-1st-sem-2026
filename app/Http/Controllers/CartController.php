<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

readonly final class CartController
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
    public function store(): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(): JsonResource
    {
        return new JsonResource(Cart::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResource
    {
        return new JsonResource(Cart::class);
    }
}
