<?php

declare(strict_types=1);

namespace App\Actions\V1\Product;

use App\DTOs\V1\Product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final readonly class UpdateProductAction
{


    public function __invoke(UpdateProductDto $updateProductDto, Product $product): void
    {
        DB::transaction(
            callback: function () use ($updateProductDto, $product)
            {
                if ($updateProductDto->name !== null)
                    $product->update(['name' => $updateProductDto->name,]);

                if ($updateProductDto->description !== null)
                    $product->update(['description' => $updateProductDto->description,]);

                if ($updateProductDto->price !== null)
                    $product->update(['price' => $updateProductDto->price,]);
            },
            attempts: 2
        );
    }
}
