<?php declare(strict_types=1);
namespace App\DTOs\Api\V1\Auth;

final readonly class LogoutDto
{
    public function __construct(
        public string $sessionToken,
    ) {}

    /**
     * @param array{
     *      sessionToken: string
     * } $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            sessionToken: $data['sessionToken']
        );
    }
}
