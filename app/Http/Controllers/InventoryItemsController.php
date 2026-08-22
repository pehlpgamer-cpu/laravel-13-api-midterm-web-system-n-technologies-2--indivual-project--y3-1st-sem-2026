<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryItemsRequest;
use App\Http\Requests\UpdateInventoryItemsRequest;
use App\Models\InventoryItems;

class InventoryItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryItemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItems $inventoryItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryItemsRequest $request, InventoryItems $inventoryItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItems $inventoryItems)
    {
        //
    }
}
