<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DeleteProductAction
{
    public function handle(Product $product)
    {
        DB::transaction(function () use ($product) {
            return Product::where('product_id', $product)->delete();
        });

        return Product::query()->where('product_id', $product)->get();
    }
}
