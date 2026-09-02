<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Http\Request;
use LogicException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\JWTGuard;

final class RequireBearerToken
{
    public function __construct(
        private readonly AuthFactory $auth,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (blank($token)) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $guard = $this->auth->guard('api');

        if (! $guard instanceof JWTGuard) {
            throw new LogicException('The api guard must use the jwt driver.');
        }

        $guard->forgetUser()
            ->setRequest($request)
            ->setToken($token);

        return $next($request);
    }
}
