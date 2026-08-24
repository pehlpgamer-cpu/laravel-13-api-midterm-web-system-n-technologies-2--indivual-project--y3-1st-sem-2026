<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryItemsRequest;
use App\Http\Requests\UpdateInventoryItemsRequest;
use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Http\Resources\Json\JsonResource;

final class InventoryItemController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(Inventory::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryItemsRequest $request): JsonResource
    {
        return new JsonResource(Inventory::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventoryItems): JsonResource
    {
        return new JsonResource(Inventory::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryItemsRequest $request, InventoryItem $inventoryItems): JsonResource
    {
        return new JsonResource(Inventory::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItem $inventoryItems): JsonResource
    {
        return new JsonResource(Inventory::class);
    }
}
