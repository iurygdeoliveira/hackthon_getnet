<?php

declare(strict_types=1);

namespace Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Faker\Factory;
use CoffeeCode\DataLayer\Connect;
use Api\Model\Sales;
use stdClass;

class Sale
{
    protected $faker;

    protected $connect;

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

    public function register(
        Request $request,
        Response $response
    ): Response {

        // CHECKANDO SE EXISTE PROBLEMA DE CONEXÃO COM O BANCO
        if ($this->checkBD()) {
            $this->errorBack("problem connect BD", $this->error);
            $response->getBody()->write(json_encode($this->error));
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(503);
        }

        $body = json_decode($request->getBody()->getContents());

        // LIMPANDO CAMPOS
        $body->name = filter_var($body->name, FILTER_SANITIZE_STRIPPED);
        $body->description = filter_var($body->description, FILTER_SANITIZE_STRIPPED);
        $body->amount = floatval(filter_var($body->amount, FILTER_SANITIZE_STRIPPED));

        // SALVANDO VENDA
        $sales = new Sales();
        $sales->name = $body->name;
        $sales->description = $body->description;
        $sales->amount = $body->amount;
        $sales->save();

        if ($sales->fail()) {

            $response->getBody()->write($sales->fail());
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(401);
        }

        // VENDA CADASTRADA
        $response->getBody()->write("registered sale");
        return $response
            ->withHeader('Content-Type', TYPE_RESPONSE)
            ->withStatus(200);
    }

    public function getSales(
        Request $request,
        Response $response
    ): Response {

        // CHECKANDO SE EXISTE PROBLEMA DE CONEXÃO COM O BANCO
        if ($this->checkBD()) {
            $this->errorBack("problem connect BD", $this->error);
            $response->getBody()->write(json_encode($this->error));
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(503);
        }

        $sales = (new Sales())->find()->fetch(true);
        $itens = [];
        foreach ($sales as $sale) {
            unset($sale->data()->updated_at);
            $itens[] = $sale->data();
        }

        $response->getBody()->write(json_encode($itens, JSON_UNESCAPED_UNICODE));
        return $response
            ->withHeader('Content-Type', TYPE_RESPONSE)
            ->withStatus(200);
    }
}
