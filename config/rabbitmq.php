
<?php

return [
    'host' => env('RABBITMQ_HOST', '127.0.0.1'),
    'port' => (int) env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'upsize'),
    'password' => env('RABBITMQ_PASSWORD', ''),
    'queue' => env('RABBITMQ_QUEUE', 'upsize.orders.created'),
];
