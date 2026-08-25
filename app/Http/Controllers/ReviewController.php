<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Http\Resources\Json\JsonResource;

readonly final class ReviewController
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
    public function store(): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(): JsonResource
    {
        return new JsonResource(Review::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResource
    {
        return new JsonResource(Review::class);
    }
}
