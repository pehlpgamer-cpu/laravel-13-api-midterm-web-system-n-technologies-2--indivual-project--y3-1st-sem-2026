<?php
namespace App\Http\Actions\Product;


use App\Models\Product;

class ListProductsAction
{
    public function call(int $page = 1, ?string $name = " ", ?float $min_price = 0.00, ?float $max_price = 0.00): mixed
    {
        return Product::paginate(15);
    }
}
