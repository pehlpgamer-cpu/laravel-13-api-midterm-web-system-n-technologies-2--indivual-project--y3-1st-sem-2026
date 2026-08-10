<?php
namespace App\Http\Services\Product;

use App\Http\Requests\Product\PostProductRequest;
use App\Models\Product;

class PostProductService
{
    public function call(PostProductRequest $request) : mixed
    {
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return Product::where('name', $request->name)->get();
    }
}
