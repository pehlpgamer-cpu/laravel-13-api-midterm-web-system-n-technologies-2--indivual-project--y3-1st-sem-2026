<?php

use App\Utils\Api;
use Database\Seeders\ProductSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

test('soft delete once', function()
{
    seed(ProductSeeder::class);
    $response = deleteJson(Api::v1('/products/2')); // Xiaomi Redmi Note 14 4G 128GB
    $response
        ->assertOk();
});

test('soft delete 3x - Idempotency test', function()
{
    seed(ProductSeeder::class);
    $response1 = deleteJson(Api::v1('/products/2'));
    $response1
        ->assertOk();

    $response2 = deleteJson(Api::v1('/products/2'));
    $response2
        ->assertNotFound();

    $response3 = deleteJson(Api::v1('/products/2'));
    $response3
        ->assertNotFound();

});

test('delete & retrieved record', function()
{
    seed(ProductSeeder::class);
    $deleteResponse = deleteJson(Api::v1('/products/2')); // Xiaomi Redmi Note 14 4G 128GB
    $deleteResponse->assertOk();

    $getResponse = getJson(Api::v1('/products/2'));
    $getResponse
        ->assertNotFound();
});

