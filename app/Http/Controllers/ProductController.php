<?php

namespace App\Http\Controllers;
// ACTIONS
use App\Http\Actions\Product\DeleteProductAction;
use App\Http\Actions\Product\ListProductsAction;
use App\Http\Actions\Product\PostProductAction;
use App\Http\Actions\Product\UpdateProductsAction;
use App\Http\Product\Requests\ListProductsRequest;
// REQUEST
use App\Http\Requests\Product\PostProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
// ETC
use App\Models\Product;
use Dedoc\Scramble\Attributes\QueryParameter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[QueryParameter(
        name: 'page',
        description: 'current page number.',
        type: 'int',
        default: 1,
        example: 2,
        required: false
    )]
    #[QueryParameter(
        name: 'name',
        description: 'product name.',
        type: 'string',
        default: null,
        example: "RTX 3060 TI GPU - 4GB VRAM",
        required: false
    )]
    #[QueryParameter(
        name: 'min_price',
        description: 'minimum price.',
        type: 'float',
        default: null,
        example: 10.00,
        required: false
    )]
    #[QueryParameter(
        name: 'max_price',
        description: 'maximum price.',
        type: 'float',
        default: null,
        example: 1000.00,
        required: false
    )]
    #[QueryParameter(
        name: 'sort',
        description: 'order by attribute (asc or decs)',
        type: 'string',
        default: 'rating',
        example: 'price',
        required: false
    )]
    #[QueryParameter(
        name: 'sort_order',
        description: 'ascending or descending)',
        type: 'string',
        default: 'descending',
        example: 'ascending',
        required: false
    )]
    public function index(ListProductsAction $listProductsAction, Request $request)
    {
        //return $listProductsAction->call($request);
        return ProductResource::collection($listProductsAction->call($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $request, PostProductAction $postProductAction)
    {
        return $postProductAction->call($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Product
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductsAction $updateProductsAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, DeleteProductAction $deleteProductAction)
    {
        //
    }
}
