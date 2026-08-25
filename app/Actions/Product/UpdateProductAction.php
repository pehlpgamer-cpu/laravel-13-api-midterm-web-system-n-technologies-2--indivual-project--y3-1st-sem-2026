<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\DTOs\Product\UpdateProductDto;
use App\Models\Product;
use Illuminate\Database\DatabaseManager;

final readonly class UpdateProductAction
{
    public function __construct(
        private DatabaseManager $databaseManager,
    ) {}

    public function __invoke( UpdateProductDto $updateProductDto, Product $product): void
    {
        $this->databaseManager->transaction(
            fn (): bool => $product->update([
                'name' => $updateProductDto->name,
                'description' => $updateProductDto->description,
                'price' => $updateProductDto->price,
            ]),
        );
    }
}
