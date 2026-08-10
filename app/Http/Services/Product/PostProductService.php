<?php
namespace App\Http\Services\Product;

use App\Http\Requests\Product\PostProductRequest;

class PostProductService
{
    private $request;

    public function __construct(PostProductRequest $request)
    {
        $this->request = $request;
    }

    public function getResults() : mixed
    {
        return $this->request;
    }
}
