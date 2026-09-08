<?php declare(strict_types=1);

use App\Enums\ApiVersion;
use App\Enums\Resource;
use App\Models\Product;
use App\Utils\Api;
use Database\Seeders\ProductSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

describe("Single", function() {
    test('record that exist', function() {
        seed(ProductSeeder::class);
        $response = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/1'));

        $response
            ->assertJsonStructure(["data"])
            ->assertOk();
    });

    test('non-existent record', function() {
        seed(ProductSeeder::class);
        $response = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '/10999823478917'));

        $response
            ->assertNotFound();
    });

});


describe("List", function() {
    test('empty query parameters', function() {
        seed(ProductSeeder::class);
        $response = getJson(Api::uriPath(ApiVersion::V1, Resource::Products));

        $response
            ->assertOk()
            ->assertJsonCount(15, 'data');
    });

    test('min & max price', function() {
        seed(ProductSeeder::class);

        $response = getJson(Api::uriPath(ApiVersion::V1, Resource::Products, '?minPrice=100.00&maxPrice=888.99'));
        $response
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.attributes.name', 'UGREEN Cat6 Ethernet Cable 5m')
            ->assertJsonPath('data.1.attributes.name', 'Sandisk Ultra 128GB USB Flash Drive');
    });

});
