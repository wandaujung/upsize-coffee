<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|string',
            'status_code' => 'required|string',
            'gross_amount' => 'required',
            'signature_key' => 'required|string',
            'transaction_status' => 'required|string',
        ]);

        $serverKey = config('midtrans.server_key');

        if (empty($serverKey)) {
            return response()->json([
                'message' => 'Konfigurasi Midtrans tidak tersedia'
            ], 503);
        }

        $signature = hash(
            'sha512',
            $data['order_id'] .
            $data['status_code'] .
            $data['gross_amount'] .
            $serverKey
        );

        if (!hash_equals($signature, $data['signature_key'])) {
            return response()->json([
                'message' => 'Signature Midtrans tidak valid'
            ], 403);
        }

        if (!preg_match('/^ORDER-([1-9][0-9]*)(?:-[a-f0-9-]{36})?$/i', $data['order_id'], $matches)) {
            return response()->json([
                'message' => 'Format ID transaksi tidak valid'
            ], 422);
        }

        $order = Order::find((int) $matches[1]);

        if (!$order) {
            return response()->json([
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        if (
            number_format((float) $data['gross_amount'], 2, '.', '') !==
            number_format((float) $order->total_price, 2, '.', '')
        ) {
            return response()->json([
                'message' => 'Jumlah pembayaran tidak sesuai'
            ], 422);
        }

        $status = $data['transaction_status'];
        $fraudStatus = strtolower((string) $request->input('fraud_status', 'accept'));

        if (
            in_array($status, ['settlement', 'capture'], true) &&
            $data['status_code'] === '200' &&
            $fraudStatus === 'accept'
        ) {
            $order->update([
                'payment_status' => 'paid'
            ]);
        } elseif ($order->payment_status !== 'paid') {
            if ($status === 'pending') {
                $order->update([
                    'payment_status' => 'pending'
                ]);
            } elseif (
                in_array($status, ['deny', 'expire', 'cancel', 'failure'], true)
            ) {
                $order->update([
                    'payment_status' => 'failed'
                ]);
            }
        }

        return response()->json([
            'message' => 'Status pembayaran berhasil diperbarui',
            'payment_status' => $order->payment_status
        ]);
    }
}
