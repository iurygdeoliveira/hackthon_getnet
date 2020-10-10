<?php

namespace ApiPayment\Consumers;

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use ApiPayment\Controllers\CreatePayment;

/*
 * OPENING CONNECTION
 */
$connection = new AMQPStreamConnection(
    CONF_RABBIT_HOST,
    CONF_RABBIT_PORT,
    CONF_RABBIT_USER,
    CONF_RABBIT_PASS
);
$channel = $connection->channel();

list($queue, $messageCount, $consumerCount) = $channel->queue_declare(
    CONF_RABBIT_QUEUE_NAME_CREATE_PAYMENT,
    CONF_RABBIT_QUEUE_PASSIVE,
    CONF_RABBIT_QUEUE_DURABLE,
    CONF_RABBIT_QUEUE_EXCLUSIVE,
    CONF_RABBIT_QUEUE_AUTO_DELETE
);

echo "Queue New Transaction Full - Total: $messageCount" . PHP_EOL;
echo "Queue: $queue" . PHP_EOL;
echo "Consumer Count: $consumerCount" . PHP_EOL;

/*
 * PROCESS MESSAGE TO BE CONSUMED
 */

$callback = function ($message) use ($messageCount, $channel) {
    $createPayment = new CreatePayment($message->body);

    // Confirmação de recebimento, pode excluir da fila no RabbitMQ
    $message->delivery_info['channel']->basic_ack(
        $message->delivery_info['delivery_tag']
    );
    unset($createPayment);
    list($queue, $messageCount, $consumerCount) = $channel->queue_declare(
        CONF_RABBIT_QUEUE_NAME_CREATE_PAYMENT,
        true
    );
    echo "Queue New Payment - Total: $messageCount" . PHP_EOL;
};

$channel->basic_qos(null, 1, null);

$channel->basic_consume(
    CONF_RABBIT_QUEUE_NAME_CREATE_PAYMENT,
    'Consumer New Payment 1',
    CONF_RABBIT_CONSUMER_NO_LOCAL,
    CONF_RABBIT_CONSUMER_NO_ACK,
    CONF_RABBIT_CONSUMER_EXCLUSIVE,
    CONF_RABBIT_CONSUMER_NO_WAIT,
    $callback
);

while ($channel->is_consuming()) {
    $channel->wait(null, true);
}

$channel->close();
$connection->close();