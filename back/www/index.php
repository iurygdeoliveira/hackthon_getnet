<?php


ob_start();

require __DIR__ . "/vendor/autoload.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Api\Controllers\Payment;

$app = AppFactory::create();

if (IS_DEV_MODE) {
    $app->addErrorMiddleware(true, true, true);
    ini_set("display_errors", 1);
}

// ROUTES ###########################################

// For Testing Only
// $app->get('/', function (Request $request, Response $response, $args) {
//     $payload = json_encode("Hello world! Server is running", JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//     $response->getBody()->write($payload);

//     return $response
//         ->withHeader('Content-type', 'application/json')
//         ->withStatus(200);
// });

// Create Authentication
$app->post('/authentication', Payment::class . ':Authentication');

// Create Authentication
$app->post('/login', Payment::class . ':login');


// RUN ###########################################

$app->run();

ob_end_flush();