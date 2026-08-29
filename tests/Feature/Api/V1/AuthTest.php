<?php declare(strict_types=1);

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\deleteJson;

describe('Signup', function() {

    test('w/ unique account', function() {
        $response = postJson('/api/v1/signup', [
            'username' => 'testUsername2026',
            'email' => 'testEmail2026@gmail.com',
            'password' => '1234567890-Abcdefg'
        ]);

        // TODO: verify account logic

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'token'
                ]
            ]);
    });

    test('Same account as previous', function() {
        //
    });
});




describe('Login', function()
{

    describe('w/ freshly made account from signup test', function()
    {
        test('correct credentials', function() {
            $response = postJson('/api/v1/login', [
                'email' => '',
                'password' => ''
            ]);

            $response
                ->assertStatus(201)
                ->assertJsonStructure([
                    'data' => [
                        'token'
                    ]
                ]);
        });

        test('Incorrect email', function() {
            $response = postJson('/api/v1/login', [
                'email' => '',
                'password' => ''
            ]);

            $response
                ->assertStatus(404)
                ->assertJsonStructure([
                    'data' => [
                        'token'
                    ]
                ]);
        });

        test('Incorrect password', function() {
            $response = postJson('/api/v1/login', [
                'email' => '',
                'password' => ''
            ]);

            $response
                ->assertStatus(404)
                ->assertJsonStructure([
                    'data' => [
                        'token'
                    ]
                ]);
        });

        test('soft deleted account', function()
        {
            // soft delete account logic
            // DeleteUserAction()
            $response = $this->postJson('/api/v1/login', [
                'email' => '',
                'password' => ''
            ]);

            $response
                ->assertStatus(404)
                ->assertJsonStructure([
                    'data' => [
                        'token'
                    ]
                ]);
        });
    });

    test("Account that doesn't exist", function() {
        $response = postJson('/api/v1/login', [
                'email' => '',
                'password' => ''
            ]);

            $response
                ->assertStatus(404)
                ->assertJsonStructure([
                    'data' => [
                        'token'
                    ]
                ]);
    });
});
