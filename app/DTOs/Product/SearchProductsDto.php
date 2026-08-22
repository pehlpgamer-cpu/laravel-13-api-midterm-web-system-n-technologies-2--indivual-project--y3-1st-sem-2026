<?php

namespace App\DTOs\Product;

final readonly class SearchProductsDto
{
    public function __construct
    (
        public ?string $name,
        public ?string $sort,
        public ?string $sortOrder,
        public ?float $minPrice,
        public ?float $maxPrice,

    ) { }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            sort: $data['sort'] ?? null,
            sortOrder: $data['sortOrder'] ?? null,
            minPrice: $data['minPrice'] ?? null,
            maxPrice: $data['maxPrice'] ?? null,
        );
    }
}
