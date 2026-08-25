<?php  declare(strict_types=1);

namespace App\Queries;


use App\Models\Product;
use App\DTOs\Product\SearchProductsDto;

readonly final class ListProductsQuery
{
    // ! FIX only "name" param works fine
    public function __invoke(SearchProductsDto $searchProductsDto)
    {
        $builder = Product::query();

        if ($searchProductsDto->name !== null) {
            $builder->orWhere('name', 'like', '%' . $searchProductsDto->name . '%');
        }

        if ($searchProductsDto->minPrice !== null) {
            $builder->orWhere('price', '>=', $searchProductsDto->minPrice);
        }

        if ($searchProductsDto->maxPrice !== null) {
            $builder->orWhere('price', '<=', $searchProductsDto->maxPrice);
        }

        $sortOrder = ($searchProductsDto->sortOrder && $searchProductsDto->sortOrder === 'asc') ?
            'asc' : 'desc';

        if ($searchProductsDto->sort !== null) {
            switch ($searchProductsDto->sort) {
                case 'price':

                case 'name':

                case 'rating':
                    $builder->orderBy($searchProductsDto->sort, $sortOrder);
                    break;

                default:
            }
        }

        return $builder->paginate(15);
    }
}
