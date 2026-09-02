<?php

use App\Models\Product;
use function Pest\Laravel\postJson;




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


