<?php

declare(strict_types=1);

namespace App\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use LogicException;
use Tymon\JWTAuth\JWTGuard;

final readonly class JwtTokenService
{
    public function __construct(
        private AuthFactory $auth,
    ) {
    }

    /**
     * @param array<string, mixed> $credentials
     */
    public function attempt(array $credentials): ?string
    {
        $token = $this->guard()->attempt($credentials);

        return is_string($token) ? $token : null;
    }

    public function issueFor(User $user): string
    {
        return $this->guard()->login($user);
    }

    public function refresh(): string
    {
        return $this->guard()->refresh();
    }

    public function invalidate(): void
    {
        $this->guard()->logout();
    }

    public function ttlSeconds(): int
    {
        $ttl = $this->guard()->factory()->getTTL();

        if ($ttl === null) {
            throw new LogicException('JWT_TTL must not be null.');
        }

        return (int) $ttl * 60;
    }

    private function guard(): JWTGuard
    {
        $guard = $this->auth->guard('api');

        if (! $guard instanceof JWTGuard) {
            throw new LogicException(
                'The api guard must use the jwt driver.',
            );
        }

        return $guard;
    }
}
