<?php declare(strict_types=1);
namespace App\Actions\Product;
use App\DTOs\Product\QueryProductsDto;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class QueryProductsAction
{
    function __invoke(QueryProductsDto $queryProductsDto): LengthAwarePaginator
    {
        $query = Product::query();
        if ($queryProductsDto->name !== null) {
            $query->orWhere('name', 'like', '%' . $queryProductsDto->name . '%');
        }

        if ($queryProductsDto->minPrice !== null)
            $query->where('price', '>=', $queryProductsDto->minPrice);


        if ($queryProductsDto->maxPrice !== null)
            $query->where('price', '<=', $queryProductsDto->maxPrice);

        $sortOrder = ($queryProductsDto->sortOrder && $queryProductsDto->sortOrder === 'asc') ?
            'asc' : 'desc';

        if ($queryProductsDto->sort !== null) {
            switch ($queryProductsDto->sort) {
                case 'price':

                case 'name':

                case 'rating':
                    $query->orderBy($queryProductsDto->sort, $sortOrder);
                    break;

                default:
            }
        }
        return $query->paginate(15);
    }
}


