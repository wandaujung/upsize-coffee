<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NotificationService
{
    public function send($order)
    {
        try {
            return Http::timeout(3)->post(
                'http://notification-service:8001/api/notifications',
                [
                    'order_id' => $order->id,
                    'message' => 'Pesanan baru dari ' . $order->name,
                ]
            );
        } catch (\Exception $e) {
            return null;
        }
    }
}
