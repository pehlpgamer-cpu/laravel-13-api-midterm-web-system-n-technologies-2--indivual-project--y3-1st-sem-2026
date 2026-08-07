<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddProductRequest;
use Dedoc\Scramble\Attributes\Api;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        $validated = $request->validated();

        if ($validated)
        {
            return response()->json([
                "msg" => "hello"
            ], 201);
        }

        return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
