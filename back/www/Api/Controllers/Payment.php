<?php

declare(strict_types=1);

namespace Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Faker\Factory;
use GuzzleHttp\Client as ClientGetNet;
use GuzzleHttp\Psr7\Request as RequestGetNet;
use GuzzleHttp\Exception\RequestException;
use CoffeeCode\DataLayer\Connect;

class Payment
{
    public function __construct()
    {
        if (IS_DEV_MODE) {
            $this->faker = Factory::create('pt_BR');
        }
    }

    public function testRoute()
    {
        $parameters = func_get_args();
        // var_dump($parameters);

        return $parameters[0];
    }

    // 'Content-Type' => 'application/json'
    // 'Content-Type' => 'application/x-www-form-urlencoded'
    public function requestGetNet(
        string $contentType,
        array $body,
        string $authString
    ) {

        $parameters = func_get_args();
        // var_dump($parameters);

        //Requisição Sincrona
        try {
            $client = new ClientGetNet([
                'base_uri' => CONF_URL_GATEWAY,
                'timeout' => 0,
                'headers' => [
                    'content-type' => $contentType,
                    'authorization' => "Basic " . $authString
                ],
                'form_params' => $body
            ]);

            // var_dump($client);
            $request = new RequestGetNet('POST', ROUTE_AUTHENTICATION);
            $response = $client->send($request);
            $code = $response->getStatusCode();
            $phrase = $response->getReasonPhrase();
            $body = $response->getBody()->getContents();

            echo "\n" . "Response" . "\n";
            echo "Code: $code" . "\n";
            echo "pharse: $phrase" . "\n";
            echo "body: " . "\n";
            echo $body;
        } catch (RequestException $error) {
            print_r($error->getResponse());
        }
    }

    public function Authentication(
        Request $request,
        Response $response,
        array $args
    ): Response {

        $this->requestGetNet(
            'application/x-www-form-urlencoded',
            [
                "scope" => "oob",
                "grant_type" => "client_credentials",
            ],
            base64_encode(CONF_CLIENT_ID . ":" . CONF_CLIENT_SECRET)
        );

        $parsedBody = $request->getParsedBody();
        $response->getBody()->write($this->testRoute("Working Route"));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }


    // public function createToken(Request $request, Response $response, array $args): Response
    // {
    //     $parsedBody = $request->getParsedBody();
    //     $response->getBody()->write(json_encode("Hello world!"));

    //     return $response
    //         ->withHeader('Content-Type', 'application/json')
    //         ->withStatus(200);

    //     // REQUISIÇÃO SINCRONA
    //     try {

    //         $request = new Request('POST', CREATE_TRANSACTIONS);
    //         $response = $client->send($request);
    //         $headers = $response->getHeaders();
    //         $code = $response->getStatusCode(); // 200
    //         $reason = $response->getReasonPhrase(); // OK
    //         $body = json_decode($response->getBody()->getContents());
    //         echo "<br> ## Headers ## <br>";
    //         var_dump($headers);
    //         echo "## Code: $code ## <br>";
    //         echo "## Reason: $reason ## <br>";
    //         echo "## Body ## <br>";
    //         var_dump($body);
    //     } catch (ClientException $error) {
    //         var_dump(Psr7\str($error->getRequest()));
    //         var_dump(Psr7\str($error->getResponse()));
    //     }

    //     //Requisição Assíncrona
    //     //     $getMessage = new Client([
    //     //         'base_uri' => CONF_URL_PAYMENT,
    //     //         'timeout' => 0,
    //     //         'headers' => [
    //     //             'Content-Type' => 'application/json',
    //     //             'merchant_id' => CONF_MERCHANT_ID,
    //     //             'merchant_key' => CONF_MERCHANT_KEY
    //     //         ],
    //     //         'body' => json_encode($data)
    //     //     ]);

    //     //     $request = new Request('GET', CREATE_TRANSACTIONS);
    //     //     $promise = $storage->sendAsync($request);

    //     //     $promise->then(
    //     //         function (ResponseInterface $response) {
    //     //             global $headers, $code, $phrase, $body;
    //     //             $headers = $response->getHeaders();
    //     //             $code = $response->getStatusCode();
    //     //             $phrase = $response->getReasonPhrase();
    //     //             $body = json_decode($response->getBody()->getContents());
    //     //         },
    //     //         function (RequestException $error) {
    //     //             echo "<br> ## Error ## <br>";
    //     //             var_dump($error->getMessage());
    //     //             echo "<br> ## Request ## <br>";
    //     //             var_dump($error->getRequest()->getMethod());
    //     //         }
    //     //     );

    //     //     $promise->wait();
    //     // }
    // }
}