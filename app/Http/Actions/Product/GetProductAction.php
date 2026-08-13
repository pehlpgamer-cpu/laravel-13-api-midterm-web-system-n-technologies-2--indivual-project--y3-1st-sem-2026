<?php
namespace App\Http\Actions\Product;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class GetProductAction
{
    public function call(int $id): JsonResponse
    {
        return Product::where('product_id', $id)->get();
    }

}
