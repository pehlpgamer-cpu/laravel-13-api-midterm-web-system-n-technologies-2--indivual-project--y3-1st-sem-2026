<?php declare(strict_types=1);
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
use Illuminate\Http\Resources\Json\JsonResource;

readonly final class ProductController
{

    /**
     * Display a listing of the resource.
     */
    #[QueryParameter( name: 'page',       description: 'current page number.',             required: false, type: 'int',       default: 1,             example: 2)]
    #[QueryParameter( name: 'name',       description: 'product name.',                    required: false, type: 'string',    default: null,          example: 'RTX 3060 TI GPU - 4GB VRAM')]
    #[QueryParameter( name: 'min_price',  description: 'minimum price.',                   required: false, type: 'float',     default: null,          example: 10.00)]
    #[QueryParameter( name: 'max_price',  description: 'maximum price.',                   required: false, type: 'float',     default: null,          example: 1000.00)]
    #[QueryParameter( name: 'sort',       description: 'order by attribute (asc or decs)', required: false, type: 'string',    default: 'rating',      example: 'price')]
    #[QueryParameter( name: 'sort_order', description: 'ascending or descending)',         required: false, type: 'string',    default: 'descending',  example: 'ascending')]
    public function index(ListProductsRequest $listProductsRequest, SearchProductsDto $searchProductsDto, ListProductsQuery $listProductsQuery): JsonResource
    {
        $data = $searchProductsDto::fromArray($listProductsRequest->validated());
        return ProductResource::collection($listProductsQuery($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostProductRequest $postProductRequest, PostProductAction $postProductAction)
    {

        // * FIXED the error: "message": "Unresolvable dependency resolving [Parameter #0 [ <required> string $name ]] in class App\\DTOs\\Product\\CreateProductDto",
        // apparently method dependency injection of Dto is not possible, probably because of "Laravel ✨MAGIC✨"
        // and Codex 5.6 Sol Ultra was not able to figure that out.
        $data = CreateProductDto::fromArray($postProductRequest->validated());
        $postProductAction($data);
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
    public function update(UpdateProductRequest $updateProductRequest, Product $product, UpdateProductAction $updateProductAction): JsonResource
    {
        $updateProductDto = UpdateProductDto::fromArray($updateProductRequest->validated());
        return ProductResource::make($updateProductAction($updateProductDto, $product));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product, DeleteProductAction $deleteProductAction): JsonResource
    {
        return ProductResource::collection($deleteProductAction($product));
    }
}
