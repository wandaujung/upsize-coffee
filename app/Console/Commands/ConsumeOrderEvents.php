<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpAmqpLib\Connection\AMQPConnectionConfig;
use PhpAmqpLib\Connection\AMQPConnectionFactory;

#[Signature('rabbitmq:consume-orders')]
#[Description('Consume order events from RabbitMQ')]
class ConsumeOrderEvents extends Command
{
    public function handle(): int
    {
        $config = new AMQPConnectionConfig();
        $url = config('rabbitmq.url');

        if (is_string($url) && $url !== '') {
            $parts = parse_url($url);

            if ($parts === false || !isset($parts['host']) || !in_array($parts['scheme'] ?? '', ['amqp', 'amqps'], true)) {
                throw new \InvalidArgumentException('RABBITMQ_URL tidak valid');
            }

            $secure = $parts['scheme'] === 'amqps';

            $config->setHost($parts['host']);
            $config->setPort((int) ($parts['port'] ?? ($secure ? 5671 : 5672)));
            $config->setUser(rawurldecode($parts['user'] ?? 'guest'));
            $config->setPassword(rawurldecode($parts['pass'] ?? ''));

            $path = $parts['path'] ?? '';

            $config->setVhost(
                $path === '' || $path === '/'
                    ? '/'
                    : rawurldecode(substr($path, 1))
            );

            $config->setIsSecure($secure);

            if ($secure) {
                $config->setSslVerify(true);
                $config->setSslVerifyName(true);
            }
        } else {
            $config->setHost((string) config('rabbitmq.host'));
            $config->setPort((int) config('rabbitmq.port'));
            $config->setUser((string) config('rabbitmq.user'));
            $config->setPassword((string) config('rabbitmq.password'));
            $config->setVhost((string) config('rabbitmq.vhost', '/'));
        }

        $config->setConnectionTimeout(10.0);
        $config->setReadTimeout(120.0);
        $config->setWriteTimeout(120.0);

        $connection = AMQPConnectionFactory::create($config);

        try {
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
                            $this->info('Pesan pengujian berhasil diterima');
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
        } finally {
            $connection->close();
        }

        return self::SUCCESS;
    }
}
