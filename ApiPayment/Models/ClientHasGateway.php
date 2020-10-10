<?php

namespace ApiPayment\Models;

use CoffeeCode\DataLayer\DataLayer;

class ClientHasGateway extends Datalayer
{
    public function __construct()
    {
        // nome da tabela, campos obrigatorios, primary key =  id, $timestamps = true
        parent::__construct(
            "clients_has_gateway",
            ["client_id_gateway", "client_id", "gateway_id"],
            "id",
            false
        );
    }
}
