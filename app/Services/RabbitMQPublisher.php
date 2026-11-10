<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPConnectionConfig;
use PhpAmqpLib\Connection\AMQPConnectionFactory;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQPublisher
{
    public function publish(array $data): void
    {
        $config = new AMQPConnectionConfig();
        $url = config('rabbitmq.url');

        if (is_string($url) && $url !== '') {
            $parts = parse_url($url);

            if (
                $parts === false ||
                !isset($parts['host']) ||
                !in_array($parts['scheme'] ?? '', ['amqp', 'amqps'], true)
            ) {
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

            try {
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
            } finally {
                $channel->close();
            }
        } finally {
            $connection->close();
        }
    }
}
