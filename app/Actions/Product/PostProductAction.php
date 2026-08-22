<?php

namespace App\Actions\Product;

use App\DTOs\Product\CreateProductDto;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PostProductAction
{
    public function handle(CreateProductDto $data): mixed // <-- need to figure out the exact type
    {

        DB::transaction(function () use ($data) {
            return Product::create([
                'name' => $data->name,
                'description' => $data->description,
                'price' => $data->price,
            ]);
        });

        return Product::where('name', $data->name)->get();
    }
}
