<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class ProductResource extends JsonApiResource
{
    /**
     * The resource's attributes.
     */
    public $attributes = [
        'product_id',
        'name',
        'description',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The resource's relationships.
     */
    public $relationships = [
        // ...
    ];


}
