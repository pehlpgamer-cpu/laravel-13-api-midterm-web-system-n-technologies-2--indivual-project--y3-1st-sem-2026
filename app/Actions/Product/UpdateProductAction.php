<?php

namespace App\Actions\Product;

use App\DTOs\Product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UpdateProductAction
{
    public function handle(UpdateProductDto $data, Product $product)
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
