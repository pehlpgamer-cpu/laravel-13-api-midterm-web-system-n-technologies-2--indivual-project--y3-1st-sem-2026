<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\DTOs\Product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final readonly class UpdateProductAction
{


    public function __invoke( UpdateProductDto $updateProductDto): void
    {
        callback: DB::transaction(
            function () use ($updateProductDto) {
                Product::update([
                    'name' => $updateProductDto->name,
                    'description' => $updateProductDto->description,
                    'price' => $updateProductDto->price,
                ]);
            },
        attempts: 2
        );
    }
}
