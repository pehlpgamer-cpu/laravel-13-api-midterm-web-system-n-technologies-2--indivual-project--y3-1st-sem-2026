<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

readonly final class UserController
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
    public function store(): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(): JsonResource
    {
        return new JsonResource(User::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResource
    {
        return new JsonResource(User::class);
    }
}
