<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('pages.menu.index', compact('products'));
    }
}