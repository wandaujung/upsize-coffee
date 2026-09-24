<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }


    public function show(Product $product)
    {
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }
}