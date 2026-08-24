<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResource
    {
        return new JsonResource(User::class);
    }
}
