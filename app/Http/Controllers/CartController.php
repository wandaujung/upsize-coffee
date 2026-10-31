<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
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

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
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

    public function update(Request $request, Cart $cart)
    {
        abort_unless((int) $cart->user_id === (int) Auth::id(), 403);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update([
            'quantity' => $validated['quantity']
        ]);

        return redirect('/cart');
    }

    public function destroy(Cart $cart)
    {
        abort_unless((int) $cart->user_id === (int) Auth::id(), 403);

        $cart->delete();

        return redirect('/cart');
    }
}
