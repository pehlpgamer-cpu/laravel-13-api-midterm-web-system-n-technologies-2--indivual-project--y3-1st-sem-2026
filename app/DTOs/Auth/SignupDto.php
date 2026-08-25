<?php declare(strict_types=1);
namespace App\DTOs\Auth;

final readonly class SignupDto
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
    ) {}

    /**
     * @param array{
     *      username: string,
     *      email: string,
     *      password: string
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            username: $data['username'],
            email: $data['email'],
            password: $data['password'],
        );
    }
}
