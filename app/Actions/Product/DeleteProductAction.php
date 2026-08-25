<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Database\DatabaseManager;

final readonly class DeleteProductAction
{
    public function __construct(
        private DatabaseManager $databaseManager,
    ) {}

    public function __invoke(Product $product): void
    {
        $this->databaseManager->transaction(
            fn (): bool|null => $product->delete(),
        );
    }
}
