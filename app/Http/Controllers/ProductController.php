<?php

namespace App\Http\Controllers;


use App\Http\Requests\Product\PostProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\Product\GetAllProductsService;
use App\Http\Services\Product\GetProductService;
use App\Http\Services\Product\PostProductService;
use App\Models\Product;
use Dedoc\Scramble\Attributes\Api;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// https://youtu.be/REwEWTG_kXQ

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetAllProductsService $getAllProductsService)
    {
        return $getAllProductsService()->call();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $request, PostProductService $postProductService): JsonResponse
    {

        $result = $postProductService->call($request);
        return response()->json([
            'data' => $result
        ]);
        //return new ProductResource($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetProductService $getProductService)
    {
        return $getProductService($id)->getResponse();
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
