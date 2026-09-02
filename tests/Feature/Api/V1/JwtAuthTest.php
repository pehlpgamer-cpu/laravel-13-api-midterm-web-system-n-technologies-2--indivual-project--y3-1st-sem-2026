<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\postJson;
use function Pest\Laravel\withToken;

uses(RefreshDatabase::class);

it('logs in and accesses a protected endpoint', function (): void {
    $password = 'a-very-secure-password';

    $user = User::factory()->create([
        'email' => 'bro@example.com',
        'password' => $password,
    ]);

    $response = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => $password,
    ])->assertOk()
        ->assertJsonStructure([
            'data' => [
                'access_token',
                'token_type',
                'expires_in',
            ],
        ]);

    $token = $response->json('data.access_token');

    withToken($token)
        ->getJson('/api/auth/me')
        ->assertOk()
        ->assertJsonPath('data.id', $user->getKey());
});

it('rejects incorrect credentials', function (): void {
    User::factory()->create([
        'email' => 'bro@example.com',
        'password' => 'correct-password',
    ]);

    postJson('/api/auth/login', [
        'email' => 'bro@example.com',
        'password' => 'wrong-password',
    ])->assertUnauthorized()
        ->assertJsonPath(
            'message',
            'The provided credentials are incorrect.',
        );
});

it('rotates the token and blacklists the old token', function (): void {
    $password = 'a-very-secure-password';

    $user = User::factory()->create([
        'password' => $password,
    ]);

    $oldToken = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => $password,
    ])->json('data.access_token');

    $newToken = withToken($oldToken)
        ->postJson('/api/auth/refresh')
        ->assertOk()
        ->json('data.access_token');

    expect($newToken)->not->toBe($oldToken);

    withToken($oldToken)
        ->getJson('/api/auth/me')
        ->assertUnauthorized();

    withToken($newToken)
        ->getJson('/api/auth/me')
        ->assertOk();
});

it('blacklists the token during logout', function (): void {
    $password = 'a-very-secure-password';

    $user = User::factory()->create([
        'password' => $password,
    ]);

    $token = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => $password,
    ])->json('data.access_token');

    withToken($token)
        ->postJson('/api/auth/logout')
        ->assertNoContent();

    withToken($token)
        ->getJson('/api/auth/me')
        ->assertUnauthorized();
});
