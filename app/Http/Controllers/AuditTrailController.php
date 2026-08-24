<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditTrailRequest;
use App\Models\AuditTrail;
use Illuminate\Http\Resources\Json\JsonResource;
final class AuditTrailController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(AuditTrail::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuditTrailRequest $request): JsonResource
    {
        return new JsonResource(AuditTrail::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(AuditTrail $auditTrail): JsonResource
    {
        return new JsonResource(AuditTrail::class);
    }
}
