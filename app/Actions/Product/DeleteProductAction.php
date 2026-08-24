<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

readonly final class DeleteProductAction
{
    /**
     * @return Collection<int, Product>
     */
    public function __invoke(Product $product): Collection
    {
        DB::transaction(function () use ($product): void {
            $product->delete();
        });

        return Product::query()->get();
    }
}
