<?php

namespace ApiPayment\Producers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ReturnClient
{
    private $connection;
    private $channel;

    public function __construct($message)
    {
        $this->connection();
        $this->queueDeclare();
        $this->bind();
        $this->produceMessage(json_encode($message, JSON_UNESCAPED_UNICODE));
        $this->close();
    }

    private function connection()
    {
        $this->connection = new AMQPStreamConnection(
            CONF_RABBIT_HOST,
            CONF_RABBIT_PORT,
            CONF_RABBIT_USER,
            CONF_RABBIT_PASS
        );
        $this->channel = $this->connection->channel();
    }

    private function queueDeclare()
    {
        $this->channel->queue_declare(
            CONF_RABBIT_QUEUE_NAME_CREATE_CLIENT,
            CONF_RABBIT_QUEUE_PASSIVE,
            CONF_RABBIT_QUEUE_DURABLE,
            CONF_RABBIT_QUEUE_EXCLUSIVE,
            CONF_RABBIT_QUEUE_AUTO_DELETE
        );
    }

    private function bind()
    {
        $this->channel->queue_bind(
            CONF_RABBIT_QUEUE_NAME_CREATE_CLIENT,
            CONF_RABBIT_EXCHANGE_NAME,
            CONF_RABBIT_ROUTING_KEY_NAME_CREATE_CLIENT
        );
    }

    private function produceMessage($message)
    {
        $msgCreate = new AMQPMessage($message, [
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        $this->channel->basic_publish(
            $msgCreate,
            CONF_RABBIT_EXCHANGE_NAME,
            CONF_RABBIT_ROUTING_KEY_NAME_RETURN_CLIENT
        );
        unset($msgCreate);
    }

    private function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}