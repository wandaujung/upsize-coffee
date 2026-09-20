<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NotificationService
{
    public function send($order)
    {
        return Http::post(
            'http://127.0.0.1:8001/api/notifications',
            [
                'order_id' => $order->id,
                'message' => 'Pesanan baru dari ' . $order->name,
            ]
        );
    }
}