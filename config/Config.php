<?php

/**
 * DEBUG
 * Change to false in the production
 */
define("IS_DEV_MODE", true);

/**
 * URL BASE
 * suggestion: https://api.dominio.com.br/v1/
 */
define("CONF_URL_BASE", "http://payment.acaiteria.com.br");
define("CONF_VERSION", "/v1");

// PAGARME
define("CONF_PAGARME_ENDPOINT_BASE", "https://api.pagar.me/1/");
define("CONF_PAGARME_API_KEY", "ak_test_pomoYLjl6jLE0dR1f7A80wiTZYHRo5");
define("CONF_PAGARME_VERSION_API", "2019-09-01");

/**
 * JSON SCHEMAS OF THE PAYMENT API
 */
define("CONF_SCHEMA_JSON_DIR", "Models");
define(
    "CONF_SCHEMA_JSON_CLIENT",
    CONF_SCHEMA_JSON_DIR . "/" . "client-schema.json"
);
define(
    "CONF_SCHEMA_JSON_CARD",
    CONF_SCHEMA_JSON_DIR . "/" . "card-schema.json"
);
define(
    "CONF_SCHEMA_JSON_TRANSACTION",
    CONF_SCHEMA_JSON_DIR . "/" . "transaction-schema.json"
);

define(
    "CONF_SCHEMA_JSON_PAYMENT",
    CONF_SCHEMA_JSON_DIR . "/" . "payment-schema.json"
);

define(
    "CONF_SCHEMA_JSON_REFUND",
    CONF_SCHEMA_JSON_DIR . "/" . "refund-schema.json"
);

/**
 * DATABASE
 */
define("CONF_BD_HOST", "localhost"); // Nome do Container no docker-compose
define("CONF_BD_PORT", "3306");
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => CONF_BD_HOST,
    "port" => CONF_BD_PORT,
    "dbname" => "payment",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
    ],
]);

/**
 * RABBITMQ CONNECTION DATA
 */
define("CONF_RABBIT_HOST", "localhost");
// Porta para o cliente, não setar a porta 15672 que é para a interface web
// causará desconexão durante o consumo pelos clients
define("CONF_RABBIT_PORT", "5672");
define("CONF_RABBIT_USER", "admin");
define("CONF_RABBIT_PASS", "admin");
define("CONF_RABBIT_NAME", "EXCHANGE_DIRECT");
define("CONF_RABBIT_TYPE", "direct");

/**
 * RABBITMQ CONFIG EXCHANGE
 */
define("CONF_RABBIT_EXCHANGE_NAME", "EXCHANGE_DIRECT");
define("CONF_RABBIT_EXCHANGE_TYPE", "direct");
define("CONF_RABBIT_EXCHANGE_PASSIVE", false);
define("CONF_RABBIT_EXCHANGE_DURABLE", true);
define("CONF_RABBIT_EXCHANGE_AUTO_DELETE", false);

/**
 * RABBITMQ CONFIG QUEUE
 */
define("CONF_RABBIT_QUEUE_PASSIVE", false);
define("CONF_RABBIT_QUEUE_DURABLE", true);
define("CONF_RABBIT_QUEUE_EXCLUSIVE", false);
define("CONF_RABBIT_QUEUE_AUTO_DELETE", false);
define("CONF_RABBIT_QUEUE_NAME_CREATE_CLIENT", "CreateClient");
define("CONF_RABBIT_QUEUE_NAME_RETURN_CLIENT", "ReturnClient");
define("CONF_RABBIT_QUEUE_NAME_CREATE_CARD", "CreateCard");
define("CONF_RABBIT_QUEUE_NAME_RETURN_CARD", "ReturnCard");
define("CONF_RABBIT_QUEUE_NAME_CREATE_TRANSACTION", "CreateTransactionFull");
define("CONF_RABBIT_QUEUE_NAME_RETURN_TRANSACTION", "ReturnTransactionFull");
define("CONF_RABBIT_QUEUE_NAME_CREATE_PAYMENT", "CreatePayment");
define("CONF_RABBIT_QUEUE_NAME_RETURN_PAYMENT", "ReturnPayment");
define("CONF_RABBIT_QUEUE_NAME_CREATE_REFUND", "CreateRefund");
define("CONF_RABBIT_QUEUE_NAME_RETURN_REFUND", "ReturnRefund");

/**
 * RABBITMQ CONFIG ROUTING_KEY
 */
define("CONF_RABBIT_ROUTING_KEY_NAME_CREATE_CLIENT", "CreateClient");
define("CONF_RABBIT_ROUTING_KEY_NAME_RETURN_CLIENT", "ReturnClient");
define("CONF_RABBIT_ROUTING_KEY_NAME_CREATE_CARD", "CreateCard");
define("CONF_RABBIT_ROUTING_KEY_NAME_RETURN_CARD", "ReturnCard");
define(
    "CONF_RABBIT_ROUTING_KEY_NAME_CREATE_TRANSACTION",
    "CreateTransactionFull"
);
define(
    "CONF_RABBIT_ROUTING_KEY_NAME_RETURN_TRANSACTION",
    "ReturnTransactionFull"
);
define("CONF_RABBIT_ROUTING_KEY_NAME_CREATE_PAYMENT","CreatePayment");
define("CONF_RABBIT_ROUTING_KEY_NAME_RETURN_PAYMENT","ReturnPayment");
define("CONF_RABBIT_ROUTING_KEY_NAME_CREATE_REFUND","CreateRefund");
define("CONF_RABBIT_ROUTING_KEY_NAME_RETURN_REFUND","ReturnRefund");

/**
 * RABBITMQ CONFIG CONSUMER
 */
define("CONF_RABBIT_CONSUMER_IDENTIFIER", "");
define("CONF_RABBIT_CONSUMER_NO_LOCAL", false);
define("CONF_RABBIT_CONSUMER_NO_ACK", false);
define("CONF_RABBIT_CONSUMER_EXCLUSIVE", false);
define("CONF_RABBIT_CONSUMER_NO_WAIT", false);