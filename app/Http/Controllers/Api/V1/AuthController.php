<?php declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Auth\JwtTokenService;
// REQUEST
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\SignupRequest;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

final class AuthController
{
    public function __construct(
        private readonly JwtTokenService $tokens,
    ) {
    }

    public function register(SignupRequest $signupRequest): JsonResponse
    {
        $user = User::query()->create(
            $signupRequest->safe()->only(['name', 'email', 'password']),
        );

        return $this->tokenResponse(
            token: $this->tokens->issueFor($user),
            status: Response::HTTP_CREATED,
        );
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $token = $this->tokens->attempt(
            $loginRequest->safe()->only(['email', 'password']),
        );

        if ($token === null) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->tokenResponse($token);
    }

    public function me(Request $request): UserResource
    {
        /** @var User $user */
        $user = $request->user('api');

        return new UserResource($user);
    }

    public function refresh(): JsonResponse
    {
        try {
            return $this->tokenResponse($this->tokens->refresh());
        } catch (JWTException) {
            return response()->json([
                'message' => 'The token is invalid or can no longer be refreshed.',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(): Response
    {
        try {
            $this->tokens->invalidate();
        } catch (JWTException) {
            return response()->json([
                'message' => 'The token is invalid.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->noContent();
    }

    private function tokenResponse(
        string $token,
        int $status = Response::HTTP_OK,
    ): JsonResponse {
        return response()->json([
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => $this->tokens->ttlSeconds(),
            ],
        ], $status);
    }
}
