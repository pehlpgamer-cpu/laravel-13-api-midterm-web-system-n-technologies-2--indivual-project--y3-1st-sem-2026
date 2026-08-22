<?php

namespace App\DTOs\Product;

final readonly class UpdateProductDto
{
    public function __construct
    (
        public ?string $name,
        public ?string $description,
        public ?float $price,
    ) { }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            price: $data['price'] ?? null,
        );
    }
}
