<?php declare(strict_types=1);

use App\Models\User;


use function Pest\Laravel\postJson;
use function Pest\Laravel\withToken;
use App\Utils\Api;


    it('logs in and accesses a protected endpoint', function (): void
    {
        $password = 'Password-1234567890';

        $user = User::factory()->create([
            'email' => 'bro@example.com',
            'password' => $password,
        ]);

        $response = postJson(Api::v1('/auth/login'), [
            'email' => $user->email,
            'password' => $password,
        ])
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'access_token',
                'token_type',
                'expires_in',
            ],
        ]);

        $token = $response->json('data.access_token');

        withToken($token)
            ->getJson(Api::v1('/auth/me'))
            ->assertOk()
            ->assertJsonPath('data.id', $user->getKey());
    });

    it('rejects incorrect credentials', function (): void
    {
        User::factory()->create([
            'email' => 'bro@example.com',
            'password' => 'correct-Password-1234567890',
        ]);

        postJson(Api::v1('/auth/login'), [
            'email' => 'bro@example.com',
            'password' => 'wrong-Password-1234567890',
        ])->assertUnauthorized()
            ->assertJsonPath(
                'message',
                'The provided credentials are incorrect.',
            );
    });

    it('rotates the token and blacklists the old token', function (): void
    {
        $password = 'Password-1234567890';

        $user = User::factory()->create([
            'password' => $password,
        ]);

        $oldToken = postJson(Api::v1('/auth/login'), [
            'email' => $user->email,
            'password' => $password,
        ])->json('data.access_token');

        $newToken = withToken($oldToken)
            ->postJson(Api::v1('/auth/refresh'))
            ->assertOk()
            ->json('data.access_token');

        expect($newToken)->not->toBe($oldToken);

        withToken($oldToken)
            ->getJson(Api::v1('/auth/me'))
            ->assertUnauthorized();

        withToken($newToken)
            ->getJson(Api::v1('/auth/me'))
            ->assertOk();
    });


