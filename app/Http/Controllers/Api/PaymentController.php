<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $orderId = str_replace('ORDER-', '', $request->order_id);

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'message' => 'Order tidak ditemukan'
            ], 404);
        }


        if ($request->transaction_status == 'settlement') {

            $order->update([
                'payment_status' => 'paid'
            ]);

        } elseif ($request->transaction_status == 'pending') {

            $order->update([
                'payment_status' => 'pending'
            ]);

        } elseif (
            $request->transaction_status == 'deny' ||
            $request->transaction_status == 'expire' ||
            $request->transaction_status == 'cancel'
        ) {

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