<?php

namespace ApiPayment\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

class Cards extends Datalayer
{
    public function __construct()
    {
        // $entity, array com campos obrigatórios , $primary = "id", $timestamps = "true"
        parent::__construct("card", ["client_id", "client_has_gateway_id","cvv"]);
    }
}