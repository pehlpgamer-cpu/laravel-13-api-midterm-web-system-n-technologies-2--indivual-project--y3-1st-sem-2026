<?php declare(strict_types=1);
namespace App\DTOs\Auth;

final readonly class LoginDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    /**
     * @param array{
     *      email: string,
     *      password: string
     * } $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
        );
    }
}
