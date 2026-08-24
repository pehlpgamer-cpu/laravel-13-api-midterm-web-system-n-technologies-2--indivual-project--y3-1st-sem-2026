<?php

namespace App\Actions\Product;

use App\DTOs\Product\CreateProductDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

readonly final class PostProductAction
{
    /**
     * @return Collection<int, Product>
    */
    // TODO - I Think it should return associative array, because currently it's violating the single responsibility & separation of concerns principle...
    public function __invoke(CreateProductDto $data): Collection
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
