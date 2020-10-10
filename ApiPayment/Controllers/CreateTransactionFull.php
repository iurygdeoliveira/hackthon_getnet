<?php

namespace ApiPayment\Controllers;

use Opis\JsonSchema\Schema;
use ApiPayment\Controllers\Pagarme;
use ApiPayment\Producers\ReturnTransaction;
use ApiPayment\Models\Client;
use ApiPayment\Models\Cards;
use ApiPayment\Models\ClientHasGateway;
use ApiPayment\Models\Pay;
use stdClass;

class CreateTransactionFull extends Pagarme
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
        $this->createTransaction();
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

        $returnTransaction = new ReturnTransaction($data);
        unset($returnTransaction);
        return false;
    }

    private function createTransaction()
    {
        // FIXME Fazer code review da validação dos dados recebidos
        // FIXME Habilitar apenas leitura no arquivo client-schema.json
        // FIXME Criar usuario do banco para o sistema, não usar root
        // TODO Revisar try catch

        $schemaJson = __DIR__ . "/../" . CONF_SCHEMA_JSON_TRANSACTION;

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

        $integration = new Pagarme();
        $createCustomer = $integration->createCustomer(
            $body->client->document,
            $body->client->name,
            $body->client->email,
            $body->client->document,
            $body->client->cellphone,
            $body->client->birth
        );

        if (!$createCustomer) {
            $this->errorBack("problem in creating the client", $this->error);
            unset($integration);
            return false;
        }

        if (!$this->storageClient($createCustomer)) {
            $this->errorBack("Client storage problem", $this->error);
            unset($integration);
            return false;
        }

        $createCard = $integration->createCreditCard(
            $body->card->holder_name,
            $body->card->number,
            $body->card->expiration_date,
            $body->card->cvv,
            $this->clientHasGateway->data->client_id_gateway
        );

        if (!$createCard) {
            $this->errorBack("card invalid", $this->error);
            
            if ($this->client) {
                $this->client->destroy();
                unset($this->client);
            }

            if ($this->clientHasGateway) {
                $this->clientHasGateway->destroy();
                unset($this->client);
            }
            unset($integration);
            return false;
        }

        if (!$this->storageCard($createCard, $body->card->cvv)) {
            unset($integration);
            $this->errorBack("Card storage problem", $this->error);
            return false;
        }        

        $payData = $integration->payRequest($body->pay->amount, $body->pay->delivery, $body->card->cvv);

        if (!$payData) {

            if ($this->client) {
                $this->client->destroy();
                unset($this->client);
            }

            if ($this->clientHasGateway) {
                $this->clientHasGateway->destroy();
                unset($this->client);
            }
            unset($integration);
            $this->errorBack("Payment problem", $this->error);
            return false;
        }

        $storagePay = $this->storagePay($payData);

        if (!$storagePay) {
            $this->errorBack("Storage Payment problem", $this->error);
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

        $returnTransaction = new ReturnTransaction($data);
        $integration->__destruct();
        unset($integration, $returnTransaction, $this->client, $this->clientHasGateway);
        return true;
    }

    private function storageClient(stdClass $createCustomer)
    {
        $this->client = new Client();
        $this->client->name = $createCustomer->name;
        $this->client->document = $createCustomer->documents[0]->number;
        $this->client->email = $createCustomer->email;
        $this->client->born_at = $createCustomer->birthday;
        $this->client->cellphone = $createCustomer->phone_numbers[0];
        $this->client->save();

        if ($this->client->fail()) {
            $this->error = $this->client->fail();
            unset($this->client);
            return false;
        }

        $this->clientHasGateway = new ClientHasGateway();
        $this->clientHasGateway->client_id_gateway = strval($createCustomer->id);
        $this->clientHasGateway->client_id = intval($this->client->data->id);
        $this->clientHasGateway->gateway_id = 1;
        $this->clientHasGateway->save();

        if ($this->clientHasGateway->fail()) {
            if ($this->client) {
                $this->client->destroy();
                unset($this->client);
            }

            $this->error = $this->clientHasGateway->fail();
            unset($this->clientHasGateway);
            return false;
        }

        return true;
    }

    private function storageCard(stdClass $createCard, string $cvv)
    {
        $this->newCard = new Cards();
        $this->newCard->token = $createCard->id;
        $this->newCard->flag = $createCard->brand;
        $this->newCard->suffix = $createCard->last_digits;
        $this->newCard->cvv = password_hash($cvv, PASSWORD_BCRYPT);
        $this->newCard->client_id = intval($this->client->data->id);
        $this->newCard->client_has_gateway_id =
            $this->clientHasGateway->data->id;
        $this->newCard->save();

        if ($this->newCard->fail()) {
            if ($this->client) {
                $this->client->destroy();
            }

            if ($this->clientHasGateway) {
                $this->clientHasGateway->destroy();
            }

            $this->error = $this->newCard->fail();
            unset($this->newCard);
            return false;
        }

        return true;
    }

    private function storagePay(stdClass $payData)
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
        $payment->clients_id = intval($this->client->data->id);
        $payment->card_id = intval($this->newCard->data->id);
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