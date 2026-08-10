<?php

namespace App\Http\Controllers;


use App\Http\Requests\Product\PostProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\Product\GetProductService;
use App\Http\Services\Product\PostProductService;
use Dedoc\Scramble\Attributes\Api;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(?int $id = null)
    {
        return new GetProductService($id)->getResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $request)
    {
        $valid_request = $request->validated();
        $response = new PostProductService($valid_request);
        return new ProductResource($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
