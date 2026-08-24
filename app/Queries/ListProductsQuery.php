<?php

namespace App\Queries;


use App\Models\Product;
use App\DTOs\Product\SearchProductsDto;

readonly final class ListProductsQuery
{
    // ! FIX only "name" param works fine
    public function __invoke(SearchProductsDto $data)
    {
        $searchQuery = Product::query();

        if ($data->name !== null) {
            $searchQuery->orWhere('name', 'like', '%' . $data->name . '%');
        }

        if ($data->minPrice !== null) {
            $searchQuery->orWhere('price', '>=', $data->minPrice);
        }

        if ($data->maxPrice !== null) {
            $searchQuery->orWhere('price', '<=', $data->maxPrice);
        }

        $sortOrder = ($data->sortOrder && $data->sortOrder === 'asc') ?
            'asc' : 'desc';

        if ($data->sort !== null) {
            switch ($data->sort) {
                case 'price':
                    $searchQuery->orderBy($data->sort, $sortOrder);
                    break;

                case 'name':
                    $searchQuery->orderBy($data->sort, $sortOrder);
                    break;

                case 'rating':
                    $searchQuery->orderBy($data->sort, $sortOrder);
                    break;

                default:
            }
        }

        return $searchQuery->paginate(15);
    }
}
