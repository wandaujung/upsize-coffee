<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required'
        ]);


        $order = Order::find($request->order_id);


        if ($request->status == 'success') {

            $order->update([
                'payment_status' => 'paid'
            ]);

        } else {

            $order->update([
                'payment_status' => 'failed'
            ]);

        }


        return response()->json([
            'message' => 'Status pembayaran berhasil diperbarui',
            'payment_status' => $order->payment_status
        ]);
    }
}