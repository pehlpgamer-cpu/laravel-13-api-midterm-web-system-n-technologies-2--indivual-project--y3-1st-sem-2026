<?php

use App\Models\Product;
use Database\Seeders\ProductSeeder;

use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

describe("Single", function() {
    test('record that exist', function() {
        // Product::factory()->create();
        seed(ProductSeeder::class);
        $response = getJson("api/v1/products/1");

        $response
            ->assertJsonStructure(["data"])
            ->assertOk();
    });
});


describe("List", function() {
    test('default or empty url parameters', function() {
        seed(ProductSeeder::class);


    });


});
