<?php

namespace ApiPayment\Controllers;

use Opis\JsonSchema\Schema;
use ApiPayment\Controllers\Pagarme;
use ApiPayment\Producers\ReturnPayment;
use ApiPayment\Models\Client;
use ApiPayment\Models\Cards;
use ApiPayment\Models\ClientHasGateway;
use ApiPayment\Models\Pay;
use stdClass;

class CreatePayment extends Pagarme
{
    private $jsonValid;
    private $message;
    private $client;
    private $clientHasGateway;
    private $newCard;

    public function __construct($message)
    {
        parent::__construct();

        if ($this->error) {
            $this->errorBack("problem connect db", $this->error->getMessage());
            return false;
        }

        $this->message = $message;
        $this->createPayment();
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

        $returnPayment = new ReturnPayment($data);
        unset($returnPayment);
        return false;
    }

    private function createPayment()
    {
        // FIXME Fazer code review da validação dos dados recebidos
        // FIXME Habilitar apenas leitura no arquivo client-schema.json
        // FIXME Criar usuario do banco para o sistema, não usar root
        // TODO Revisar try catch

        $schemaJson = __DIR__ . "/../" . CONF_SCHEMA_JSON_PAYMENT;

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

        $card = new Cards();
        $gateway = new ClientHasGateway();
        $cardData = $card->find("client_id=:client_id AND id=:id","client_id={$body->client_id}&id={$body->card_id}")->fetch(); 
        $idGateway = $gateway->find(
            "client_id=:client_id AND id=:id","client_id={$cardData->data->client_id}&id={$cardData->data->client_has_gateway_id}")->fetch();       
        
        $integration = new Pagarme();
        $integration->getCustomerPagarme($idGateway->data->client_id_gateway);        
        $integration->getCreditCard($cardData->data->token);        
        $payData = $integration->payRequest($body->amount, $body->delivery, $body->cvv);

        if (!$payData) {

            if ($card) {
                $card->destroy();
                unset($card);
            }

            if ($gateway) {
                $gateway->destroy();
                unset($gateway);
            }

            unset($integration);
            $this->errorBack("Payment problem", $this->error);
            return false;
        }

        $storagePay = $this->storagePay($payData,$cardData->data->client_id, $cardData->data->id);

        if (!$storagePay) {
            $this->errorBack("Storage Payment problem", $this->error);
            unset($integration,$gateway,$card);
            return false;
        }

        // Response Successful
        $data = [
            "response" => [
                "type" => "Successful",
                "message" => "Payment OK",
                "order_id" => $storagePay->data->id,
                "status" => $storagePay->data->status,
            ],
        ];

        $returnPayment = new ReturnPayment($data);
        $integration->__destruct();
        unset($integration, $returnPayment,$gateway,$card);
        return true;
    }

    private function storagePay(stdClass $payData, $client_id, $card_id)
    {
        $payment = new Pay();

        $payment->id_transaction = strval($payData->id_transaction);
        $payment->status = $payData->status;
        $payment->refuse_reason = $payData->refuse_reason;
        $payment->acquirer_name = $payData->acquirer_name;
        $payment->acquirer_response_code = $payData->acquirer_response_code;
        $payment->authorization_code = $payData->authorization_code;
        $payment->amount = floatval($payData->amount);
        $payment->authorized_amount = floatval($payData->authorized_amount);
        $payment->payment_method = $payData->payment_method;
        $payment->cost = floatval($payData->cost);
        $payment->antifraud_score = $payData->antifraud_score;
        $payment->ip = $payData->ip;
        $payment->clients_id = intval($client_id);
        $payment->card_id = intval($card_id);
        $payment->created_at = $payData->created_at;
        $payment->updated_at = $payData->updated_at;
        $payment->save();

        if ($payment->fail()) {
            $this->error = $payment->fail();
            unset($payment);
            return false;
        }

        return $payment;
    }
}