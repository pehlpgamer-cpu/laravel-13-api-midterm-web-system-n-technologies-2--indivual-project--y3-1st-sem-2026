<?php
namespace App\Http\Actions\Product;

use App\Http\Requests\Product\PostProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostProductAction
{
    public function call(PostProductRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request) {
            return Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        });

        return Product::where('name', $request->name)->get();
    }
}
