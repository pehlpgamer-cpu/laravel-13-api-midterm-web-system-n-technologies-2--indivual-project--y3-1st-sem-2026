<?php
namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Request;

class GetProductService
{
    private mixed $response;

    public function __construct(int $id)
    {
        $this->response = Product::where('product_id', $id)->get();
    }

    function getResponse(): mixed
    {
        return $this->response;
    }
}
