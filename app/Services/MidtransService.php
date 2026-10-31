<?php

namespace App\Services;

use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($order)
    {
        if (app()->environment('testing')) {
            return 'testing-snap-token';
        }

        $transactionId = 'ORDER-' . $order->id . '-' . Str::uuid();

        $params = [
            'transaction_details' => [
                'order_id' => $transactionId,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->name,
            ],
        ];

        return Snap::getSnapToken($params);
    }
}
