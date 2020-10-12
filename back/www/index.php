<?php


ob_start();

require __DIR__ . "/vendor/autoload.php";

use Slim\Factory\AppFactory;
use Api\Controllers\Payment;
use Api\Controllers\Access;

$app = AppFactory::create();

if (IS_DEV_MODE) {
    $app->addErrorMiddleware(true, true, true);
    ini_set("display_errors", 1);
}

// ROUTES ###########################################

// Create Authentication
$app->post('/authentication', Payment::class . ':Authentication');

// Create and Check Login
$app->post('/login', Access::class . ':login');


// RUN ###########################################

$app->run();

ob_end_flush();