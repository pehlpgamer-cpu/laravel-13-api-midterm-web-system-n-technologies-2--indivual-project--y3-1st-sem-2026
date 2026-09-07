<?php declare(strict_types=1);
namespace App\Actions\Product;
use App\DTOs\Product\QueryProductsDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class QueryProductsAction
{
    function __invoke(QueryProductsDto $queryProductsDto): LengthAwarePaginator
    {
        // ! FIX only "name" param works fine
        $builder = Product::query();

        if ($queryProductsDto->name !== null) {
            $builder->orWhere('name', 'like', '%' . $queryProductsDto->name . '%');
        }

        if ($queryProductsDto->minPrice !== null) {
            $builder->orWhere('price', '>=', $queryProductsDto->minPrice);
        }

        if ($queryProductsDto->maxPrice !== null) {
            $builder->orWhere('price', '<=', $queryProductsDto->maxPrice);
        }

        $sortOrder = ($queryProductsDto->sortOrder && $queryProductsDto->sortOrder === 'asc') ?
            'asc' : 'desc';

        if ($queryProductsDto->sort !== null) {
            switch ($queryProductsDto->sort) {
                case 'price':

                case 'name':

                case 'rating':
                    $builder->orderBy($queryProductsDto->sort, $sortOrder);
                    break;

                default:
            }
        }
        return $builder->paginate(15);
    }
}


