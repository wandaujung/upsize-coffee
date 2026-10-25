<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\RabbitMQPublisher;
use Illuminate\Support\Facades\Log;

class PublishOrderToRabbitMQ
{
    public function handle(OrderCreated $event): void
    {
        try {
            app(RabbitMQPublisher::class)->publish([
                'event_id' => 'order.created.' . $event->order->id,
                'event_type' => 'order.created',
                'order_id' => $event->order->id,
            ]);

            Log::info('Order event published to RabbitMQ', [
                'order_id' => $event->order->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('RabbitMQ publish failed', [
                'order_id' => $event->order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
