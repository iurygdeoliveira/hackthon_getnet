<?php

namespace ApiPayment\Faker;

use Faker\Factory;
use ApiPayment\Models\Client;
use ApiPayment\Models\Cards;
use ApiPayment\Models\ClientHasGateway;
use ApiPayment\Models\Pay;

class MakeFaker
{
    public function ClientFaker()
    {
        $faker = Factory::create('pt_BR');

        $client = [
            "payload" => [
                "name" => $faker->name,
                "document" => $faker->cpf,
                "birth" => $faker->date('Y-m-d', 'now'),
                "email" => $faker->email,
                "cellphone" => $faker->cellphone,
                "client_has_gateway" => '0',
                "user_id" => '0',
            ],
        ];

        var_dump(json_encode($client, JSON_UNESCAPED_UNICODE));
        return json_encode($client, JSON_UNESCAPED_UNICODE);
    }

    public function CardFaker()
    {
        $clientHasGateway = new ClientHasGateway();
        $clientName = new Client();

        $faker = Factory::create('pt_BR');

        $result = $clientHasGateway->findById($faker->numberBetween(832, 1831));
        $name = $clientName->findById($result->data->client_id)->data()->name;

        $card = [
            "payload" => [
                'holder_name' => strtoupper($name),
                'number' => $faker->creditCardNumber,
                'expiration_date' => $faker->creditCardExpirationDateString,
                'cvv' => strval($faker->numberBetween(111, 999)),
                'customer_id' => $result->data->client_id,
                'client_has_gateway' => $result->data->id,
            ],
        ];

        var_dump(json_encode($card, JSON_UNESCAPED_UNICODE));
        return json_encode($card, JSON_UNESCAPED_UNICODE);
    }

    public function PaymentFaker()
    {

        $faker = Factory::create('pt_BR');
        
        $order = [
            "payload" => [
                'client_id' => "27428",
                'card_id' => "1887",
                'order_id' => $faker->numberBetween(1000, 9000),
                'amount' => strval($faker->randomFloat(2, 10, 300)),
                'delivery' => strval($faker->randomFloat(2, 2, 6)),
                'cvv' => "285"
            ],
        ];

        var_dump(json_encode($order, JSON_UNESCAPED_UNICODE));
        return json_encode($order, JSON_UNESCAPED_UNICODE);
    }

    public function RefundFaker()
    {

        $faker = Factory::create('pt_BR');
        $order = new Pay();

        $order_id = $order->findById($faker->numberBetween(2741,2749))->data()->id;
        
        $order = [
            "payload" => [
                'order_id' => $order_id,
                ],
        ];

        var_dump(json_encode($order, JSON_UNESCAPED_UNICODE));
        return json_encode($order, JSON_UNESCAPED_UNICODE);
    }

    public function TransactionFaker()
    {
        $client = json_decode($this->ClientFaker());

        $faker = Factory::create('pt_BR');
 
        $cvv = strval($faker->numberBetween(111, 999));
        $order = [
            "payload" => [
                'client' => [
                    "name" => $client->payload->name,
                    "document" => $client->payload->document,
                    "birth" => $client->payload->birth,
                    "email" => $client->payload->email,
                    "cellphone" => $client->payload->cellphone,
                    "client_has_gateway" => $client->payload->client_has_gateway,
                    "user_id" => $client->payload->user_id
                ],
                'card' => [
                'holder_name' => strtoupper($client->payload->name),
                'number' => $faker->creditCardNumber,
                'expiration_date' => $faker->creditCardExpirationDateString,
                'cvv' => $cvv,
                'customer_id' => "0",
                'client_has_gateway' => "0"
                ],
                'pay' => [
                    'id' => $faker->numberBetween(1000, 9000),
                    'amount' => strval($faker->randomFloat(2, 10, 300)),
                    'delivery' => strval($faker->randomFloat(2, 2, 6)),
                    'cvv' => $cvv
                ],
            ],
        ];

        var_dump(json_encode($order, JSON_UNESCAPED_UNICODE));
        return json_encode($order, JSON_UNESCAPED_UNICODE);
    }
}