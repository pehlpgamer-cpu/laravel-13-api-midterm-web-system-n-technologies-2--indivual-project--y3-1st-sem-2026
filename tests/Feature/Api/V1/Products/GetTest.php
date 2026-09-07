<?php

use App\Models\Product;
use Database\Seeders\ProductSeeder;

use function Pest\Laravel\getJson;
use function Pest\Laravel\seed;

describe("Single", function() {
    test('record that exist', function() {
        seed(ProductSeeder::class);
        $response = getJson("api/v1/products/1");

        $response
            ->assertJsonStructure(["data"])
            ->assertOk();
    });

    test('trashed record as non-Admin role', function() {

        // seed(ProductSeeder::class);
        // $response = getJson("api/v1/products/1");

        // $response
        //     ->assertJsonStructure(["data"])
        //     ->assertOk();
    });

    test('trashed record as Admin role', function() {

    });
});


describe("List", function() {
    test('default or empty url parameters', function() {
        seed(ProductSeeder::class);


    });


});
