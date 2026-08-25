<?php
declare(strict_types=1);
namespace App\DTOs\Product;

final readonly class UpdateProductDto
{
    public function __construct(
        public ?string $name,
        public ?string $description,
        public ?float $price,
    ) {}

    /**
     * @param array{
     *     name?: string|null,
     *     description?: string|null,
     *     price?: float|int|null
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            price: isset($data['price'])
                ? (float) $data['price']
                : null,
        );
    }
}
