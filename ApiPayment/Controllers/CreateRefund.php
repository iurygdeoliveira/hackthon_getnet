<?php

namespace ApiPayment\Controllers;

use Opis\JsonSchema\Schema;
use ApiPayment\Controllers\Pagarme;
use ApiPayment\Producers\ReturnRefund;
use ApiPayment\Models\Client;
use ApiPayment\Models\Cards;
use ApiPayment\Models\ClientHasGateway;
use ApiPayment\Models\Pay;
use stdClass;

class CreateRefund extends Pagarme
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
        $this->createRefund();
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

        $returnRefund = new ReturnRefund($data);
        unset($returnRefund);
        return false;
    }

    private function createRefund()
    {
        // FIXME Fazer code review da validação dos dados recebidos
        // FIXME Habilitar apenas leitura no arquivo client-schema.json
        // FIXME Criar usuario do banco para o sistema, não usar root
        // TODO Revisar try catch

        $schemaJson = __DIR__ . "/../" . CONF_SCHEMA_JSON_REFUND;

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

        $order = new Pay();
        $orderData = $order->find($body->order_id)->fetch(); 
        
        var_dump($orderData);

        $integration = new Pagarme();                
        $refundData = $integration->Refund($orderData->data->id_transaction, $orderData->data->amount);

        var_dump($this->error);
        var_dump($refundData);
        $storageRefund = $this->storageRefund($refundData,$orderData->data->id, $orderData->data->clients_id, $orderData->data->card_id);
        
        if (!$storageRefund) {
            $this->errorBack("Storage Payment problem", $this->error);
            unset($integration, $order, $returnRefund, $refundData);
            return false;
        }
        
        // Response Successful
        $data = [
            "response" => [
                "type" => "Successful",
                "message" => "Refund OK",
                "order_id" => $storageRefund->data->id,
                "status" => $storageRefund->data->status,
            ],
        ];

        $returnRefund = new ReturnRefund($data);
        $integration->__destruct();
        unset($integration, $order, $returnRefund);
        return true;

    }

    private function storageRefund($refundData, $order_id,$client_id,$card_id)
    {

        $order = new Pay();
        $orderData = $order->find($order_id)->fetch();

        $orderData->status = $refundData->status;
        $orderData->refuse_reason = $refundData->refuse_reason;
        $orderData->acquirer_name = $refundData->acquirer_name;
        $orderData->acquirer_response_code = $refundData->acquirer_response_code;
        $orderData->authorization_code = $refundData->authorization_code;
        $orderData->amount = floatval($refundData->amount/100);
        $orderData->authorized_amount = floatval($refundData->authorized_amount/100);
        $orderData->cost = floatval($refundData->cost/100);
        $orderData->ip = $refundData->ip;
        $orderData->clients_id = intval($client_id);
        $orderData->card_id = intval($card_id);
        $orderData->created_at = $refundData->date_created;
        $orderData->updated_at = $refundData->date_updated;
        $orderData->save();

        if ($orderData->fail()) {
            $this->error = $orderData->fail();
            unset($refund);
            return false;
        }

        return $orderData;
    }
}