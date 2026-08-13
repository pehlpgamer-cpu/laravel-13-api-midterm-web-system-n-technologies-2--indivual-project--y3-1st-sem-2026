<?php
namespace App\Http\Actions\Product;


use App\Models\Product;
use Illuminate\Http\JsonResponse;

class UpdateProductsAction
{
    public function call(): JsonResponse
    {
        return Product::paginate(15);
    }
}
