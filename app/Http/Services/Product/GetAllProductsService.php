<?php
namespace App\Http\Services\Product;

use App\Models\Product;

class GetAllProductsService
{

    public function call(): mixed
    {
        return Product::paginate(15);
    }
}
