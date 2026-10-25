<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQPublisher
{
    public function publish(array $data): void
    {
        $connection = new AMQPStreamConnection(
            config('rabbitmq.host'),
            config('rabbitmq.port'),
            config('rabbitmq.user'),
            config('rabbitmq.password')
        );

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

            $message = new AMQPMessage(
                json_encode($data, JSON_THROW_ON_ERROR),
                [
                    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                    'content_type' => 'application/json'
                ]
            );

            $channel->basic_publish(
                $message,
                '',
                $queue
            );

            $channel->close();
        } finally {
            $connection->close();
        }
    }
}
