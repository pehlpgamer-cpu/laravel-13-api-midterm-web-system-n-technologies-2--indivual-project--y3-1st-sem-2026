<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\SignupAction;
use App\DTOs\Auth\LoginDto;
use App\DTOs\Auth\LogoutDto;
use App\DTOs\Auth\SignupDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

// * seems like this guide is incompatible with my api...
// ? https://www.souysoeng.com/2025/12/laravel-12-vue-3-authentication.html
readonly final class AuthController
{

    public function signup(SignupRequest $signupRequest, SignupDto $signupDto, SignupAction $signupAction): JsonResource
    {
        $data = $signupDto::fromArray($signupRequest->validated());
        $result = $signupAction($data);
        return UserResource::make($result);
    }

    public function login(LoginRequest $loginRequest, LoginDto $loginDto, LoginAction $loginAction): JsonResource
    {
        $data = $loginDto::fromArray($loginRequest->validated());
        $result = $loginAction($data);
        return UserResource::make($result);
    }

    public function logout(LogoutRequest $logoutRequest, LogoutDto $logoutDto, LogoutAction $logoutAction): JsonResponse
    {
        $data = $logoutDto::fromArray($logoutRequest->validated());
        $result = $logoutAction($data);
        return response()->json([]);
    }
}
