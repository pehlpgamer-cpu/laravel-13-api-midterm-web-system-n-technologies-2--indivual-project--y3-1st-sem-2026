<?php

use App\Enums\ApiVersion;
use App\Enums\Resource;
use App\Utils\Api;
use Database\Seeders\ProductSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

test('soft delete once', function()
{
    seed(ProductSeeder::class);
    $response = deleteJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/2')); // Xiaomi Redmi Note 14 4G 128GB
    $response
        ->assertOk();
});

test('soft delete 3x - Idempotency test', function()
{
    seed(ProductSeeder::class);
    $response1 = deleteJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/2'));
    $response1
        ->assertOk();

    $response2 = deleteJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/2'));
    $response2
        ->assertNotFound();

    $response3 = deleteJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/2'));
    $response3
        ->assertNotFound();

});

test('delete then retrieved record w/ status 404', function()
{
    seed(ProductSeeder::class);
    $deleteResponse = deleteJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/2')); // Xiaomi Redmi Note 14 4G 128GB
    $deleteResponse->assertOk();

    $getResponse = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/2'));
    $getResponse
        ->assertNotFound();
});

