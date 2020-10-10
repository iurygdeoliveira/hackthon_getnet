<?php

namespace ApiPayment\Models;

use CoffeeCode\DataLayer\DataLayer;

class Pay extends Datalayer
{
    public function __construct()
    {
        // $entity, array com campos obrigatórios , $primary = "id", $timestamps = "true"
        parent::__construct("orders", 
        ["id_transaction", 
        "status", 
        "authorization_code", 
        "amount",
        "authorized_amount", 
        "clients_id", 
        "card_id"]);
    }
}