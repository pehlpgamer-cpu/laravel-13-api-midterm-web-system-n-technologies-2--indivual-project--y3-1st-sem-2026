<?php
declare(strict_types=1);
namespace App\DTOs\V1\Product;

final readonly class QueryProductsDto
{
    public function __construct(
        public ?string $name,
        public ?string $sort,
        public ?string $sortOrder,
        public ?float $minPrice,
        public ?float $maxPrice,
    ) {}

    /**
     * @param array{
     *     name?: string|null,
     *     sort?: string|null,
     *     sortOrder?: string|null,
     *     minPrice?: float|null,
     *     maxPrice?: float|null
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            sort: $data['sort'] ?? null,
            sortOrder: $data['sortOrder'] ?? null,
            minPrice:
                isset($data['minPrice'])
                ? (float) $data['minPrice']
                : null,
            maxPrice:
                isset($data['maxPrice'])
                ? (float) $data['maxPrice']
                : null,
        );
    }
}
