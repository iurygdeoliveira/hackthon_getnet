<?php

namespace ApiPayment\Controllers;

use DateTimeZone;
use DateTime;
use CoffeeCode\DataLayer\Connect;
use PagarMe\Client as PagarmeClient;
use PagarMe\Exceptions\PagarMeException;
use Opis\JsonSchema\Validator;
use Opis\JsonSchema\ValidationResult;
use Opis\JsonSchema\ValidationError;
use stdClass;

class Pagarme
{
     
    protected $connect;

    protected $pagarme;

    protected $card;
    
    protected $paydata;

    protected $error;

    public function __construct()
    {
        // CONNECT BD
        $this->connect = Connect::getInstance();
        $this->error = Connect::getError();
        $this->pagarme = new PagarmeClient(CONF_PAGARME_API_KEY);
    }

    /**
     * Class destructor.
     */
    public function __destruct()
    {
        unset($this->pagarme);
        unset($this->payData);
    }

    protected function clearField(string $param)
    {
        return str_replace(['.', '/', '-', '(', ')', ','], '', $param);
    }

    public function getError()
    {
        return $this->error;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    protected function validateJson($data, $schema)
    {
        $validator = new Validator();

        /** @var ValidationResult $result */
        $result = $validator->schemaValidation($data, $schema);

        if ($result->isValid()) {
            $data = json_decode($data);
            $data = $data->payload;
            unset($validator);
            return $data;
        } else {
            /** @var ValidationError $error */
            $error = $result->getFirstError();
            $this->error = [
                "response" => [
                    "type" => "error",
                    "message" => "invalid json data",
                    "key" => $error->dataPointer(),
                    "data" => $error->data(),
                    "property" => $error->keyword(),
                    "expected" => $error->keywordArgs(),
                ],
            ];
            return false;
        }
    }

    /**
     * createClient
     *
     * @param string $id = identificador do usuario no BD
     * @param string $name
     * @param string $email
     * @param string $document = Número do CPF contendo somente números
     * @param string $phone = Número de telefone sem o DDI
     * @param string $birthday
     * @return void
     */
    public function createCustomer(
        string $user_id,
        string $name,
        string $email,
        string $document,
        string $phone,
        string $birthday
    ): ?\stdClass {
        try {
            $customer = $this->pagarme->customers()->create([
                'external_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'type' => 'individual',
                'country' => 'br',
                'documents' => [
                    [
                        'type' => 'cpf',
                        'number' => $this->clearField($document),
                    ],
                ],
                'phone_numbers' => ['+55' . $this->clearField($phone)],
                'birthday' => $birthday,
            ]);

            $this->customer = $customer;
            return $customer;
        } catch (PagarMeException $error) {
            $this->error = $error->getMessage();
            return null;
        }
    }

    /**
     * getClient
     *
     * @param string $id = ID de dentro do sistema da pagarme
     * @return void
     */
    public function getCustomerPagarme(string $id): ?\stdClass
    {
        try {
            $customer = $this->pagarme->customers()->get([
                'id' => $id,
            ]);

            $this->customer = $customer;
            return $customer;
        } catch (PagarMeException $error) {
            $this->error = $error->getMessage();
            return null;
        }
    }

    /**
     * createCreditCard
     *
     * @param string $holderName = nome como está impresso no cartão de crédito
     * @param string $cardNumber = número do cartão
     * @param string $expiration = data de expiração
     * @param string $cvv = digito de verificação
     * @param string $idClient = Id dentro da pagarme
     */
    public function createCreditCard(
        string $holderName,
        string $cardNumber,
        string $expiration,
        string $cvv,
        string $idClient = null
    ): ?\stdClass {
        try {
            $card = $this->pagarme->cards()->create([
                'holder_name' => strtoupper($holderName),
                'number' => $cardNumber,
                'expiration_date' => $this->clearField($expiration),
                'cvv' => $cvv,
                'customer_id' => $idClient,
            ]);

            // Caso o cartão não seja valido
            if ($card->valid !== true) {
                $this->error = "Cartão Inválido";
                return null;
            }

            $this->card = $card;
            return $card;
        } catch (PagarMeException $error) {
            $this->error = $error->getMessage();
            return null;
        }
    }

    public function getCreditCard(string $cardId): ?\stdClass
    {
        try {
            $card = $this->pagarme->cards()->get([
                'id' => $cardId,
            ]);

            $this->card = $card;
            return $card;
        } catch (PagarMeException $error) {
            $this->error = $error->getMessage();
            return null;
        }
    }

    public function payRequest(string $amount, string $delivery, string $cvv): ?stdClass
    {
        // TODO questionar alberto, se soft_descritor será diferente para o cenário de fretes adicionais
        $amount = floatval($amount);
        $delivery = floatval($delivery);

        try {
            $transaction = $this->pagarme->transactions()->create([
                'amount' => intval(($amount + $delivery) * 100),
                'soft_descriptor' => 'Delivery',
                'card_id' => $this->card->id,
                'card_cvv' => $cvv,
                'payment_method' => 'credit_card',
                'customer' => [
                    'external_id' => $this->customer->external_id,
                    'name' => $this->customer->name,
                    'email' => $this->customer->email,
                    'type' => 'individual',
                    'country' => 'br',
                    'documents' => [
                        [
                            'type' => 'cpf',
                            'number' => $this->customer->documents[0]->number,
                        ],
                    ],
                    'phone_numbers' => [$this->customer->phone_numbers[0]],
                ],
            ]);

            $this->payData = new stdClass();

            // identificação da transação // integer
            $this->payData->id_transaction = $transaction->id;

            // status da transação // string
            $this->payData->status = $transaction->status;

            // Motivo pelo qual a transação foi recusada. // string
            $this->payData->refuse_reason = $transaction->refuse_reason;

            // Adquirente responsável pelo processamento da transação. // string
            $this->payData->acquirer_name = $transaction->acquirer_name;

            //Mensagem de resposta da adquirente referente ao status da transação. // string
            $this->payData->acquirer_response_code =
                $transaction->acquirer_response_code;

            //Código de autorização retornado pela bandeira. // string
            $this->payData->authorization_code = $transaction->authorization_code;

            // Valor, em centavos, da transação. R$ 100,00 = 10000 // integer
            $this->payData->amount = $transaction->amount / 100;

            // Valor em centavos autorizado na transação, sempre menor ou igual a amount. // integer
            $this->payData->authorized_amount = $transaction->authorized_amount / 100;

            // Método de pagamento // string
            $this->payData->payment_method = $transaction->payment_method;

            // Custo da transação para o lojista, envolvendo processamento e antifraude. // float
            $this->payData->cost = $transaction->cost;

            // Nota de antifraude atribuída a transação. Lembrando que por padrão, transações com score >= 95 são recusadas. // string
            $this->payData->antifraud_score = $transaction->antifraud_score;

            // IP de origem que criou a transação // string
            $this->payData->ip = $transaction->ip;

            // Data de criação da transação no formato ISODate // string
            $this->payData->created_at = $transaction->date_created;

            // Data de atualização da transação no formato ISODate // string
            $this->payData->updated_at = $transaction->date_updated;

            return $this->payData;
        } catch (PagarMeException $error) {
            $this->error = $error->getMessage();
            return null;
        }
    }

    public function Refund(string $id, ?float $amount = null)
    {
        echo "aqui";
        try {
            if (!empty($amount)) {
                $data = [
                    'id' => $id,
                    'amount' => strval(($amount * 100)),
                ];
            } else {
                $data = [
                    'id' => $id,
                ];
            }

            $refundedTransaction = $this->pagarme
                ->transactions()
                ->refund($data);
            var_dump($refundedTransaction);
            return $refundedTransaction;
        } catch (PagarMeException $error) {
            $this->error = $error->getMessage();
            return null;
        }
    }

    public function NormalizeTimeZone(string $param): string
    {
        $timezone = new DateTimeZone("America/Araguaina");
        $dateTime = new DateTime($param);
        $dateTime->setTimezone($timezone);
        return $dateTime->format("Y-m-d H:i:s");
    }
}