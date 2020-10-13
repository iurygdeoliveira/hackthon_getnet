<?php

/**
 * URL BASE
 * suggestion: https://api.dominio.com.br/v1/
 */
define("CONF_URL_BASE", "http://localhost");

/**
 * URL BASE_PAYMENT
 * Change to https://esitef-ec.softwareexpress.com.br
 */
define("CONF_URL_GATEWAY", "https://api-sandbox.getnet.com.br");

/**
 * API identification and E-Commerce
 */
define("CONF_SELLER_ID", "338f404e-45bc-4d6b-8d21-0d27d1b2ab67");
define("CONF_CLIENT_ID", "cb1523c4-f3aa-486c-b795-176251ddfceb");
define("CONF_CLIENT_SECRET", "5d32af55-7244-42a1-ba85-b1cf16fe9cb0");

/**
 * API GET ROUTES
 */
define("ROUTE_AUTHENTICATION", "/auth/oauth/v2/token");


/**
 * DEBUG
 * Change to false in the production
 */
define("IS_DEV_MODE", false);

/**
 * DATABASE
 */
define("CONF_BD_HOST", "mysql");
define("CONF_BD_PORT", "3306");
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => CONF_BD_HOST,
    "port" => CONF_BD_PORT,
    "dbname" => "api",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);