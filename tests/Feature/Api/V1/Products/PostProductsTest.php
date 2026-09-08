<?php

use App\Enums\ApiVersion;
use App\Enums\Resource;
use App\Models\Product;
use App\Utils\Api;

use function Pest\Laravel\postJson;




test('Valid request body: status 201', function() {
    $response = postJson(Api::uriPath(ApiVersion::V1, Resource::Products), [
        'name' => 'EcoFlow River 2 490wh',
        'description' => '',
        'price' => 28000.00,
    ]);

    $response
        ->assertCreated(); // TODO - business logic must return this status
});

test('empty request body: status 404', function() {
    $response = postJson(Api::uriPath(ApiVersion::V1, Resource::Products), []);

    $response
        ->assertUnprocessable(); // TODO - must be different status code
});


