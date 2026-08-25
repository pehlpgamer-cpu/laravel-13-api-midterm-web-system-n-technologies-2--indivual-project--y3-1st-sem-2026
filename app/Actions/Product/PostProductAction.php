<?php declare(strict_types=1);

namespace App\Actions\Product;

use App\DTOs\Product\CreateProductDto;
use App\Models\Product;
use Illuminate\Database\DatabaseManager;

readonly final class PostProductAction
{
    public function __construct(
        private DatabaseManager $databaseManager,
    ) {
    }

    public function __invoke(CreateProductDto $createProductDto): void
    {
        $this->databaseManager->transaction(
            fn () => Product::query()->create([
                'name' => $createProductDto->name,
                'description' => $createProductDto->description,
                'price' => $createProductDto->price,
            ])
        );
    }
}
