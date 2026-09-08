<?php declare(strict_types=1);

use App\Enums\ApiVersion;
use App\Models\User;
use App\Utils\Api;

use function Pest\Laravel\postJson;
use function Pest\Laravel\withToken;

it('blacklists the token during logout', function (): void
{
    $password = 'Password-1234567890';

    $user = User::factory()->create([
        'password' => $password,
    ]);

    $token = postJson(Api::uriPath(v: ApiVersion::V1, path:'/auth/login'), [
        'email' => $user->email,
        'password' => $password,
    ])->json('data.access_token');

    withToken($token)
        ->postJson(Api::uriPath(v: ApiVersion::V1, path:'/auth/logout'))
        ->assertNoContent();

    withToken($token)
        ->getJson(Api::uriPath(v: ApiVersion::V1, path:'/auth/me'))
        ->assertUnauthorized();
});

