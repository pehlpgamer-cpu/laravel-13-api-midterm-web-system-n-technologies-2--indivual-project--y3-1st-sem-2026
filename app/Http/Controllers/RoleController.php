<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

readonly final class RoleController
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
    public function store(): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(): JsonResource
    {
        return new JsonResource(Role::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResource
    {
        return new JsonResource(Role::class);
    }
}
