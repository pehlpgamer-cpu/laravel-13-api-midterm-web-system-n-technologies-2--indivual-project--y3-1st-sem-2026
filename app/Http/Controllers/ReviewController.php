<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Http\Resources\Json\JsonResource;

final class ReviewController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): JsonResource
    {
        return new JsonResource(Review::class);
    }
}
