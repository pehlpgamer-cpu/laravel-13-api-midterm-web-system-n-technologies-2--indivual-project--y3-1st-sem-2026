<?php

declare(strict_types=1);

namespace App\Actions\V1\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

final readonly class DeleteProductAction
{
    /**
     * @return array [
     *      httpStatus: int
     *  ]
     */
    public function __invoke(Product $product): array
    {

        if ($product->trashed())
            return [ 'httpStatus' => 404 ];

        DB::transaction(
            callback: function() use ($product){
                $product->delete();
            },
            attempts: 2
        );
        return [ 'httpStatus' => 200 ];
    }
}
