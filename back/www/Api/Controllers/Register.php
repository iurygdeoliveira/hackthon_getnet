<?php

declare(strict_types=1);

namespace Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Faker\Factory;
use CoffeeCode\DataLayer\Connect;
use Api\Model\Login;

/**
 * NOME, CPF, SENHA, CELULAR 
 */

class Register
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

    public function ValidateCPF(string $cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return $cpf;
    }

    public function login(
        Request $request,
        Response $response
    ): Response {

        // CHEKANDO SE EXISTE PROBLEMA DE CONEXÃO COM O BANCO
        if ($this->checkBD()) {
            $this->errorBack("problem connect BD", $this->error);
            $response->getBody()->write(json_encode($this->error));
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(503);
        }

        $body = json_decode($request->getBody()->getContents());

        // LIMPANDO CAMPOS
        $body->cpf = filter_var($body->cpf, FILTER_SANITIZE_STRIPPED);
        $body->pass = filter_var($body->pass, FILTER_SANITIZE_STRIPPED);

        //VERIFICANDO VALIDADE DO CPF
        $body->cpf = $this->ValidateCPF($body->cpf);


        if (!$body->cpf) {

            $response->getBody()->write(
                "invalid cpf"
            );
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(401);
        }

        // VERIFICANDO SE LOGIN EXISTE
        $login = new Login();
        $loginData = $login->find("cpf=:cpf", "cpf=$body->cpf")->fetch();

        if (empty($loginData->data())) {

            $response->getBody()->write(
                "nonexistent user"
            );
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(401);
        }

        // VERIFICANDO SE SENHA ESTÁ CORRETA
        // if (password_verify($body->pass, $loginData->data()->pass)) {
        if ($body->pass === $loginData->data()->pass) {

            $response->getBody()->write($loginData->data()->name);
            return $response
                ->withHeader('Content-Type', TYPE_RESPONSE)
                ->withStatus(200);
        }

        // SENHA INCORRETA
        $response->getBody()->write("incorret password");
        return $response
            ->withHeader('Content-Type', TYPE_RESPONSE)
            ->withStatus(401);
        //      }
    }
}