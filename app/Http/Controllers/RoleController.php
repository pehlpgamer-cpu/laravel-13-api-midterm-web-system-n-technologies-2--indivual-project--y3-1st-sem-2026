<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

final class RoleController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $review): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $review): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $review): JsonResource
    {
        return new JsonResource(Role::class);
    }
}
