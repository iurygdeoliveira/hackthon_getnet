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
use Api\Model\Auth;
use DateTime;

class Payment
{
    protected $faker;

    protected $connect;

    protected $getnet;

    protected $card;

    protected $paydata;

    protected $error;

    public function __construct()
    {
        if (IS_DEV_MODE) {
            $this->faker = Factory::create('pt_BR');
            define("TYPE_RESPONSE", 'text/html');
        } else {
            define("TYPE_RESPONSE", 'application/json');
        }
    }

    public function checkBD()
    {
        $this->connect = Connect::getInstance();
        $this->error = Connect::getError();

        if ($this->error) {
            return false;
        }
    }

    private function errorBack(
        string $message,
        string $error
    ): bool {

        $this->error = [
            "response" => [
                "type" => "Error",
                "message" => $message,
                "error" => $error,
            ],
        ];
        return true;
    }

    public function testRoute()
    {
        $parameters = func_get_args();
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

            if ($code === 200) {
                return json_decode($response->getBody()->getContents());
            } else {
                $this->error =
                    [
                        "code" => $response->getStatusCode(),
                        "phrase" => $response->getReasonPhrase()
                    ];
                return false;
            }
        } catch (RequestException $error) {
            $this->error = $error->getResponse();
            return false;
        }
    }

    public function getToken()
    {
        return $this->requestGetNet(
            'application/x-www-form-urlencoded',
            [
                "scope" => "oob",
                "grant_type" => "client_credentials",
            ],
            base64_encode(CONF_CLIENT_ID . ":" . CONF_CLIENT_SECRET)
        );
    }

    public function Authentication(
        Request $request,
        Response $response,
        array $args
    ): Response {

        // CHEKANDO SE EXISTE PROBLEMA DE CONEXÃO COM O BANCO
        if ($this->checkBD()) {
            $this->errorBack("problem connect BD", $this->error);
            $response->getBody()->write(json_encode($this->error));
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(503);
        }

        // VERIFICANDO SE TOKEN EXPIROU
        $auth = new Auth();
        $authData = $auth->findById(1);

        // EXISTE ALGUM TOKEN SALVO ?
        if (!$authData) {

            // ENTÃO OBTER TOKEN
            $token = $this->getToken();

            if (!$token) {
                // ERRO NA GERAÇÃO DO TOKEN
                $this->errorBack("Authentication error", $this->error);
                $response->getBody()->write(json_encode($this->error));
                return $response
                    ->withHeader('Content-Type', TYPE_RESPONSE)
                    ->withStatus(503);
            }

            $auth->token = $token->access_token;
            $auth->type = $token->token_type;
            $auth->expire = $token->expires_in;
            $auth->save();

            // RETORNANDO TOKEN RECEM CRIADO
            $response->getBody()->write($token->access_token);

            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(200);
        }

        $interval = date_diff(new DateTime("now"), new DateTime($authData->data->updated_at));

        if ($interval->h >= 1) {

            // RENOVANDO TOKEN
            $token = $this->getToken();

            if (!$token) {
                // ERRO NA GERAÇÃO DO TOKEN
                $this->errorBack("Authentication error", $this->error);
                $response->getBody()->write(json_encode($this->error));
                return $response
                    ->withHeader('Content-Type', TYPE_RESPONSE)
                    ->withStatus(503);
            }

            $authData->data->token = $token->access_token;
            $authData->data->type = $token->token_type;
            $authData->data->expire = $token->expires_in;
            $authData->save();

            $response->getBody()->write($token->access_token);

            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(200);
        }

        $response->getBody()->write($authData->data->token);

        return $response
            ->withHeader('Content-Type', TYPE_RESPONSE)
            ->withStatus(200);
    }
}