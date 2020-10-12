<?php


ob_start();

require __DIR__ . "/vendor/autoload.php";

use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Api\Controllers\Payment;
use Api\Controllers\Access;

$app = AppFactory::create();

if (IS_DEV_MODE) {
    $app->addErrorMiddleware(true, true, true);
    ini_set("display_errors", 1);
}

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


// ROUTES ###########################################

// Create Authentication
$app->post('/authentication', Payment::class . ':Authentication');

// Create and Check Login
$app->post('/login', Access::class . ':login');

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

// RUN ###########################################

$app->run();

ob_end_flush();