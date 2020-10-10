<?php

namespace ApiPayment\Controllers;

use Opis\JsonSchema\Schema;
use ApiPayment\Controllers\Pagarme;
use ApiPayment\Models\Cards;
use ApiPayment\Models\ClientHasGateway;
use ApiPayment\Producers\ReturnCard;

class CreateCard extends Pagarme
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

        $this->createCard();
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

        $returnCard = new ReturnCard($data);
        unset($returnCard);
        return false;
    }

    private function createCard()
    {
        // FIXME Fazer code review da validação dos dados recebidos
        // FIXME Habilitar apenas leitura no arquivo client-schema.json
        // FIXME Criar usuario do banco para o sistema, não usar root
        // TODO Revisar try catch

        $schemaJson = __DIR__ . "/../" . CONF_SCHEMA_JSON_CARD;

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

        $client_has_gateway = new ClientHasGateway();
        $gatewayData = $client_has_gateway->findById(
            intval($body->client_has_gateway)
        );

        // CREATE CARD
        $integration = new Pagarme();
        $createCard = $integration->createCreditCard(
            $body->holder_name,
            $body->number,
            $body->expiration_date,
            $body->cvv,
            $gatewayData->data->client_id_gateway
        );

        if (!$createCard) {
            $this->errorBack("card invalid", $this->error);
            unset($integration, $client_has_gateway, $gatewayData);
            return false;
        }

        $card = new Cards();
        $card->token = $createCard->id;
        $card->flag = $createCard->brand;
        $card->suffix = $createCard->last_digits;
        $card->cvv = password_hash($body->cvv, PASSWORD_BCRYPT);
        $card->client_id = intval($gatewayData->data->client_id);
        $card->client_has_gateway_id = intval($body->client_has_gateway);
        $card->save();

        if ($card->fail()) {
            $this->errorBack("problem to store the card", $this->error);
            $card->destroy();
            unset($integration, $client_has_gateway, $card);
            return false;
        }

        $data = [
            "response" => [
                "type" => "Successful",
                "message" => "Card Create",
                "card_id" => $card->id,
            ],
        ];

        $returnCard = new ReturnCard($data);
        $integration->__destruct();
        unset($returnCard, $integration, $client_has_gateway, $card);

        return true;
    }
}