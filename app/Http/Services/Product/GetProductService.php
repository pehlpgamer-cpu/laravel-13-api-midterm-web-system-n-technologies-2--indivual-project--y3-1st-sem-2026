<?php
namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Request;

class GetProductService
{
    private mixed $response;

    public function __construct(?int $id = null)
    {
        if ($id)
        {
            $this->response = Product::where('product_id', $id)->get();
        }
        else $this->response = Product::paginate(15);
    }

    function getResponse(): mixed
    {
        return $this->response;
    }
}
