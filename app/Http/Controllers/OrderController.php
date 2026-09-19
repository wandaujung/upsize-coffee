<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();


        return view('pages.checkout.index', compact('carts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'table_number' => 'required',
        ]);


        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();


        if ($carts->count() == 0) {

            return redirect('/cart');

        }


        $total = 0;


        foreach ($carts as $cart) {

            $total += $cart->product->price * $cart->quantity;

        }


        $order = Order::create([

            'user_id' => Auth::id(),

            'name' => $request->name,

            'table_number' => $request->table_number,

            'total_price' => $total,

            'status' => 'pending',

            'payment_status' => 'pending',

        ]);



        foreach ($carts as $cart) {


            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $cart->product_id,

                'quantity' => $cart->quantity,

                'price' => $cart->product->price,

            ]);

        }



        Cart::where('user_id', Auth::id())->delete();



        event(new OrderCreated($order));



        return redirect('/orders')
            ->with('success', 'Pesanan berhasil dibuat');

    }
}