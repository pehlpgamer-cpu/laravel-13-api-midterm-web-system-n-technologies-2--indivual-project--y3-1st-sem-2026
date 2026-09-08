<?php

use App\Enums\ApiVersion;
use App\Enums\Resource;
use App\Utils\Api;
use Database\Seeders\ProductSeeder;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\seed;



describe('PUT', function() {
    test('update all fields', function()
    {
        seed(ProductSeeder::class);

        $putResponse = putJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'), [
            'name' => 'new product name 01',
            'description' => 'updated description...',
            'price' => 99999.99,
        ]);

        $putResponse
            ->assertStatus(200);

        $getResponse = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'));
        $getResponse
            ->assertJsonPath('data.attributes.name', 'new product name 01')
            ->assertJsonPath('data.attributes.description', 'updated description...')
            ->assertJsonPath('data.attributes.price', 99999.99)
            ->assertStatus(200);
    });
});

describe('PATCH', function() {
    test('name', function()
    {
        seed(ProductSeeder::class);

        $putResponse = putJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'), [
            'name' => 'new product name 01',
        ]);

        $putResponse
            ->assertStatus(200);

        $getResponse = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'));
        $getResponse
            ->assertJsonPath('data.attributes.name', 'new product name 01')
            ->assertStatus(200);
    });

    test('description', function()
    {
        seed(ProductSeeder::class);

        $putResponse = putJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'), [
            'description' => 'updated description...',
        ]);

        $putResponse
            ->assertStatus(200);

        $getResponse = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'));
        $getResponse
            ->assertJsonPath('data.attributes.description', 'updated description...')
            ->assertStatus(200);
    });

    test('price', function()
    {
        seed(ProductSeeder::class);

        $putResponse = putJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'), [
            'price' => 99999.99,
        ]);

        $putResponse
            ->assertStatus(200);

        $getResponse = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'));
        $getResponse
            ->assertJsonPath('data.attributes.price', 99999.99)
            ->assertStatus(200);
    });
});
