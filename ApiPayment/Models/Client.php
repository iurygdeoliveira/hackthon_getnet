<?php

namespace ApiPayment\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

class Client extends Datalayer
{
    public function __construct()
    {
        // nome da tabela, campos obrigatorios, primary key =  id, $timestamps = true
        parent::__construct("clients", ["name", "document"]);
    }
}
