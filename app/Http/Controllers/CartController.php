<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Product $product)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();


        if ($cart) {

            $cart->update([
                'quantity' => $cart->quantity + 1
            ]);

        } else {

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);

        }


        return redirect('/menu');
    }



    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();


        $total = 0;


        foreach ($carts as $cart) {

            $total += $cart->product->price * $cart->quantity;

        }


        return view('pages.cart.index', compact('carts', 'total'));
    }



    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect('/cart');
    }
}