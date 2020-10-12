<?php

namespace Api\Model;

use CoffeeCode\DataLayer\DataLayer;

class Login extends Datalayer
{
    public function __construct()
    {
        parent::__construct("login", ["cpf", "pass", "name", "phone"]);
    }
}