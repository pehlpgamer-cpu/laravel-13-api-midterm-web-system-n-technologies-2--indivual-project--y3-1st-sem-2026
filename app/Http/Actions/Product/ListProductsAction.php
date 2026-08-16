<?php

namespace App\Http\Actions\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class ListProductsAction
{
    public function call(Request $request)
    {
        $searchQuery = Product::query();

        if ($request->filled('name'))
            $searchQuery->orWhere('name', 'like', '%' . $request->name . '%');

        if ($request->filled('min_price'))
            $searchQuery->orWhere('price', '>=', $request->min_price);

        if ($request->filled('max_price'))
            $searchQuery->orWhere('price', '<=', $request->max_price);

        $sortOrder = ($request->filled('sort_order') && $request->sort_order === 'asc') ?
            'asc' : 'desc';

        if ($request->filled('sort'))
        {
            switch ($request->sort)
            {
                case 'price':
                    $searchQuery->orderBy($request->sort, $sortOrder);
                break;

                case 'name':
                    $searchQuery->orderBy($request->sort, $sortOrder);
                break;

                case 'rating':
                    $searchQuery->orderBy($request->sort, $sortOrder);
                break;

                default:
            }
        }

        return $searchQuery->paginate(15);
    }
}
