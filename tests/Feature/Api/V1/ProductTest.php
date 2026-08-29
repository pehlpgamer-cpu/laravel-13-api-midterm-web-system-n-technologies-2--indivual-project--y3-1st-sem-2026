<?php

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

describe('POST', function() {
    test('Valid request body: status 201', function() {
        $response = postJson('api/v1/products', [
            'name' => 'EcoFlow River 2 490wh',
            'description' => '',
            'price' => 28000.00,
        ]);

        $response
            ->assertCreated(); // TODO - business logic must return this status
    });

    test('empty request body: status 404', function() {
        $response = postJson('api/v1/products', []);

        $response
            ->assertUnprocessable(); // TODO - must be different status code
    });
});

describe('GET', function() {
    test('record that exist', function() {
        $response = getJson("api/v1/products/");

    });
});

describe('GET Index', function() {
    test('default / empty', function() {

    });
});

describe('PUT or PATCH', function() {

});

describe('DELETE', function() {
    test('soft', function() {

    });

    test('get soft deleted record', function() {

    });
});
