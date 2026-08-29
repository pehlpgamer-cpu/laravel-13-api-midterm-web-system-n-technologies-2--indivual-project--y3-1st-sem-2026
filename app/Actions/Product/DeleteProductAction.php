<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

final readonly class DeleteProductAction
{
    public function __invoke(Product $product): void
    {
        DB::transaction(
            fn (): bool|null => $product->delete(),
        );
    }
}
