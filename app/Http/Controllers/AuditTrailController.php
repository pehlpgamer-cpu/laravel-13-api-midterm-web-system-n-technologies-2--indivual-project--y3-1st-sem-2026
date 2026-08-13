<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Http\Requests\StoreAuditTrailRequest;
use App\Http\Requests\UpdateAuditTrailRequest;

class AuditTrailController extends Controller
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
    public function store(StoreAuditTrailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AuditTrail $auditTrail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuditTrailRequest $request, AuditTrail $auditTrail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditTrail $auditTrail)
    {
        //
    }
}
