<?php declare(strict_types=1);
namespace App\DTOs\Product;

final readonly class CreateProductDto
{
    public function __construct(
        public string $name,
        public ?string $description,
        public float $price,
    ) {}

    /**
     * @param array{
     *     name: string,
     *     description?: string|null,
     *     price: float|int
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            price: (float) $data['price'],
        );
    }
}
