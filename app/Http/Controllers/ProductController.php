<?php

namespace App\Http\Controllers;

use App\Http\Actions\Product\DeleteProductAction;
use App\Http\Actions\Product\ListProductsAction;
use App\Http\Actions\Product\PostProductAction;
use App\Http\Actions\Product\GetProductAction;
use App\Http\Actions\Product\UpdateProductsAction;
use App\Http\Requests\Product\PostProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListProductsAction $listProductsAction, int $page = 1, ?string $name = " ", ?float $min_price = 0.00, ?float $max_price = 0.00)
    {
        return ProductResource::collection($listProductsAction->call($page, $name, $min_price, $max_price));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $request, PostProductAction $postProductAction): JsonResponse
    {
        return $postProductAction->call($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, GetProductAction $getProductAction)
    {
        // return $getProductAction->call($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id, UpdateProductsAction $updateProductsAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteProductAction $deleteProductAction)
    {
        //
    }
}
