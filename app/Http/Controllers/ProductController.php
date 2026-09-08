<?php declare(strict_types=1);
namespace App\Http\Controllers;

// ACTIONS
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\PostProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Actions\Product\QueryProductsAction;

// REQUEST
use App\Http\Requests\Product\ListProductsRequest;
use App\Http\Requests\Product\PostProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

// DTO
use App\DTOs\Product\CreateProductDto;
use App\DTOs\Product\QueryProductsDto;
use App\DTOs\Product\UpdateProductDto;

// ETC
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Dedoc\Scramble\Attributes\QueryParameter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;


final class ProductController
{

    /**
     * Display a listing of the resource.
     */
    #[QueryParameter( name: 'page',       description: 'current page number.',             required: false, type: 'int',       default: 1,             example: 2)]
    #[QueryParameter( name: 'name',       description: 'product name.',                    required: false, type: 'string',    default: null,          example: 'RTX 3060 TI GPU - 4GB VRAM')]
    #[QueryParameter( name: 'minPrice',  description: 'minimum price.',                   required: false, type: 'float',     default: null,          example: 10.00)]
    #[QueryParameter( name: 'maxPrice',  description: 'maximum price.',                   required: false, type: 'float',     default: null,          example: 1000.00)]
    #[QueryParameter( name: 'sort',       description: 'order by attribute (asc or decs)', required: false, type: 'string',    default: 'rating',      example: 'price')]
    #[QueryParameter( name: 'sortOrder', description: 'ascending or descending)',         required: false, type: 'string',    default: 'descending',  example: 'ascending')]
    public function index(ListProductsRequest $listProductsRequest, QueryProductsDto $queryProductsDto, QueryProductsAction $queryProductsAction): JsonResource
    {
        $data = $queryProductsDto::fromArray($listProductsRequest->validated());
        return ProductResource::collection($queryProductsAction($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $postProductRequest, PostProductAction $postProductAction)
    {
        $data = CreateProductDto::fromArray($postProductRequest->validated());
        $response = $postProductAction($data);
        return response(status: $response['statusCode']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResource
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $updateProductRequest, Product $product, UpdateProductAction $updateProductAction)
    {
        $updateProductDto = UpdateProductDto::fromArray($updateProductRequest->validated());
        $updateProductAction($updateProductDto, $product);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product, DeleteProductAction $deleteProductAction): JsonResponse
    {
        $response = $deleteProductAction($product);
        return response()->json([], $response['httpStatus']);
    }
}
