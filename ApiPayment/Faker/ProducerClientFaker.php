<?php

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * STARTUP
 */

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use ApiPayment\Faker\MakeFaker;

/**
 * OPENING CONNECTION
 */
$connection = new AMQPStreamConnection(
    CONF_RABBIT_HOST,
    CONF_RABBIT_PORT,
    CONF_RABBIT_USER,
    CONF_RABBIT_PASS
);
$channel = $connection->channel();

/*
 * CREATING EXCHANGE IN RABBITMQ
 *
 *   Mesmo que EXCHANGE já exista no RABBITMQ, manter
 *   declaração, para que exchange seja criada
 *   e evitar perda na transmissão de dados.
 *
 *  CONF_RABBIT_NAME: Nome da exchange
 *  CONF_RABBIT_TYPE: Tipo da exchange
 *  $durable: Mantem a exchange no disco, em reinicializações do Rabbit
 *  $auto_delete: Não apagar exchange após o consumo terminar
 */

$passive = false;
$durable = true;
$auto_delete = false;
$channel->exchange_declare(
    CONF_RABBIT_NAME,
    CONF_RABBIT_TYPE,
    $passive,
    $durable,
    $auto_delete
);

/*
 * CREATING QUEUES AND ROUTING KEYS
 *
 */

$passive = false;
$durable = true;
$exclusive = false;
$auto_delete = false;

$channel->queue_declare(
    CONF_RABBIT_QUEUE_NAME_CREATE_CLIENT,
    $passive,
    $durable,
    $exclusive,
    $auto_delete
);

/*
 * LINKING QUEUES WITH EXCHANGE
 *
 */
$channel->queue_bind(
    CONF_RABBIT_QUEUE_NAME_CREATE_CLIENT,
    CONF_RABBIT_EXCHANGE_NAME,
    CONF_RABBIT_ROUTING_KEY_NAME_CREATE_CLIENT
);

/**
 * MESSAGE
 *
 * array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
 * Habilita a persistência das mensagens dentro do RabbitMQ
 * isso não garantirá totalmente que a mensagem não será perdida
 * contudo vai elevar a resiliência do processo.
 *
 */
$clientFaker = new MakeFaker();
for ($cont = 1; $cont <= 100000; $cont++) {
    $msgCreate = new AMQPMessage($clientFaker->ClientFaker(), [
        'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
    ]);

    $channel->basic_publish(
        $msgCreate,
        CONF_RABBIT_NAME,
        CONF_RABBIT_ROUTING_KEY_NAME_CREATE_CLIENT
    );
    echo "Create Message send: ";
    echo "COUNT: $cont" . PHP_EOL;
    sleep(rand(0, 5));
}

/**
 * CLOSING CONNECTION
 */

$channel->close();
$connection->close();