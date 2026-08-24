<?php

namespace App\Actions\Product;

use App\DTOs\Product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

readonly final class UpdateProductAction
{

    public function __invoke(UpdateProductDto $data, Product $product): Product
    {
        DB::transaction(function () use ($data, $product) {
            return Product::where('product_id', $product)->update([
                'name' => $data->name,
                'description' => $data->description,
                'price' => $data->price
            ]);
        });

        return $product;
    }
}
