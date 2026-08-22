<?php

namespace App\Http\Controllers;

// ACTIONS
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\PostProductAction;
use App\Actions\Product\UpdateProductAction;

// REQUEST
use App\Http\Requests\Product\ListProductsRequest;
use App\Http\Requests\Product\PostProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

// DTO
use App\DTOs\Product\CreateProductDto;
use App\DTOs\Product\SearchProductsDto;
use App\DTOs\Product\UpdateProductDto;

// ETC
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Queries\ListProductsQuery;
use Dedoc\Scramble\Attributes\QueryParameter;

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
        example: 'RTX 3060 TI GPU - 4GB VRAM',
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
    public function index(ListProductsRequest $request, ListProductsQuery $query)
    {
        $data = SearchProductsDto::fromArray($request->validated());
        return ProductResource::collection($query->handle($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $request, PostProductAction $action)
    {
        $data = CreateProductDto::fromArray($request->validated());
        return ProductResource::collection($action->handle($data));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $action)
    {
        $data = UpdateProductDto::fromArray($request->validated());
        return ProductResource::make($action->handle($data, $product));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product, DeleteProductAction $action)
    {
        return ProductResource::collection($action->handle($product));
    }
}
