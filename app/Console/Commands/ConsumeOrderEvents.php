<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpAmqpLib\Connection\AMQPStreamConnection;

#[Signature('rabbitmq:consume-orders')]
#[Description('Consume order events from RabbitMQ')]
class ConsumeOrderEvents extends Command
{
    public function handle(): int
    {
        $connection = new AMQPStreamConnection(
            config('rabbitmq.host'),
            config('rabbitmq.port'),
            config('rabbitmq.user'),
            config('rabbitmq.password')
        );

        $channel = $connection->channel();

        $queue = config('rabbitmq.queue');

        $channel->queue_declare(
            $queue,
            false,
            true,
            false,
            false
        );

        $channel->basic_qos(null, 1, null);

        $this->info('Consumer RabbitMQ aktif...');
        $this->info('Menunggu pesan dari queue: ' . $queue);

        $channel->basic_consume(
            $queue,
            '',
            false,
            false,
            false,
            false,
            function ($message) {
                try {
                    $data = json_decode(
                        $message->getBody(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );

                    $eventType = $data['event_type'] ?? '';

                    if ($eventType === 'connection.test') {
                        $this->info(
                            'Pesan pengujian berhasil diterima'
                        );
                    } elseif ($eventType === 'order.created') {
                        $orderId = $data['order_id'] ?? null;
                        $eventId = $data['event_id'] ?? null;

                        if (!$orderId || !$eventId) {
                            throw new \RuntimeException(
                                'Order ID atau Event ID tidak ditemukan'
                            );
                        }

                        DB::table('order_event_receipts')
                            ->insertOrIgnore([
                                'event_id' => $eventId,
                                'order_id' => $orderId,
                                'event_type' => $eventType,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                        $this->info(
                            'Event order.created berhasil disimpan: Order #' . $orderId
                        );
                    } else {
                        throw new \RuntimeException(
                            'Tipe event tidak dikenal: ' . $eventType
                        );
                    }

                    $message->ack();
                } catch (\Throwable $e) {
                    $this->error($e->getMessage());
                    $message->nack(false, false);
                }
            }
        );

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

        return self::SUCCESS;
    }
}
