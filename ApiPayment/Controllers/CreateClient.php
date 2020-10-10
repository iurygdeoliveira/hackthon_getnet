<?php

namespace ApiPayment\Controllers;

use Opis\JsonSchema\Schema;
use ApiPayment\Controllers\Pagarme;
use ApiPayment\Models\Client;
use ApiPayment\Models\ClientHasGateway;
use ApiPayment\Producers\ReturnClient;

class CreateClient extends Pagarme
{
    private $jsonValid;
    private $message;

    public function __construct($message)
    {
        parent::__construct();

        if ($this->error) {
            $this->errorBack("problem connect db", $this->error->getMessage());
            return false;
        }

        $this->message = $message;
        $this->createClient();
    }

    private function errorBack($message, $error)
    {
        $data = [
            "response" => [
                "type" => "Error",
                "message" => $message,
                "error" => $error,
            ],
        ];

        $returnClient = new ReturnClient($data);
        unset($returnClient);
        return false;
    }

    private function createClient()
    {
        // FIXME Fazer code review da validação dos dados recebidos
        // FIXME Habilitar apenas leitura no arquivo client-schema.json
        // FIXME Criar usuario do banco para o sistema, não usar root
        // TODO Revisar try catch

        $schemaJson = __DIR__ . "/../" . CONF_SCHEMA_JSON_CLIENT;

        //Validando dados recebidos da API Legacy
        $this->jsonValid = $this->validateJson(
            $this->message,
            Schema::fromJsonString(file_get_contents($schemaJson))
        );

        if (!$this->jsonValid) {
            $this->errorBack("json invalid", $this->error);
            return false;
        }

        $body = $this->jsonValid;

        // CREATE CLIENT
        $integration = new Pagarme();
        $createCustomer = $integration->createCustomer(
            $body->document,
            $body->name,
            $body->email,
            $body->document,
            $body->cellphone,
            $body->birth
        );

        if (!$createCustomer) {
            $this->errorBack("problem in creating the client", $this->error);
            unset($integration);
            return false;
        }

        //  STORAGE CLIENT
        $client = new Client();
        $client->name = $body->name;
        $client->document = $body->document;
        $client->email = $body->email;
        $client->born_at = $body->birth;
        $client->cellphone = $body->cellphone;
        $client->save();

        if ($client->fail()) {
            $this->errorBack("Client storage problem", $this->error);
            unset($client);
            return false;
        }

        $clientHasGateway = new ClientHasGateway();
        $clientHasGateway->client_id_gateway = strval($createCustomer->id);
        $clientHasGateway->client_id = intval($client->data->id);
        $clientHasGateway->gateway_id = 1;
        $clientHasGateway->save();

        if ($clientHasGateway->fail()) {
            if ($client) {
                $client->destroy();
                unset($client);
            }
            unset($clientHasGateway);

            $this->errorBack(
                "problem storage client has gateway",
                $this->error
            );

            return false;
        }

        $data = [
            "response" => [
                "type" => "Successful",
                "message" => "Client Create",
                "user_id" => $client->data->id,
                "client_has_gateway" => $clientHasGateway->data->id,
            ],
        ];

        $returnClient = new ReturnClient($data);
        $integration->__destruct();
        unset($returnClient, $clientHasGateway, $client, $integration);

        return true;
    }
}