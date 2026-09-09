<?php declare(strict_types=1);

namespace App\Actions\Api\V1\Product;

use App\DTOs\Api\V1\Product\CreateProductDto;
use App\Models\Product;

use Illuminate\Support\Facades\DB;

readonly final class PostProductAction
{
    /**
     * @return array{
     *     statusCode: int,
     * }
    */
    public function __invoke(CreateProductDto $createProductDto): array
    {
        $statusCode = 201;
        DB::transaction(
            callback:
                function () use ($createProductDto)
                {
                    Product::query()->create([
                        'name' => $createProductDto->name,
                        'description' => $createProductDto->description,
                        'price' => $createProductDto->price,
                    ]);
                },
            attempts: 2
        );

        return [
            'statusCode' => $statusCode,
        ];
    }
}
