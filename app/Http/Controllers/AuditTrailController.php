<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditTrailRequest;
use App\Models\AuditTrail;
use Illuminate\Http\Resources\Json\JsonResource;
readonly final class AuditTrailController
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
    public function store(StoreAuditTrailRequest $storeAuditTrailRequest): JsonResource
    {
        echo $storeAuditTrailRequest;
        return new JsonResource(AuditTrail::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(AuditTrail $auditTrail): JsonResource
    {
        return new JsonResource($auditTrail);
    }
}
