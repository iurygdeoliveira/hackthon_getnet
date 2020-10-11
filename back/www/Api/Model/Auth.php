<?php

namespace Api\Model;

use CoffeeCode\DataLayer\DataLayer;

class Auth extends Datalayer
{
    public function __construct()
    {
        parent::__construct("auth", ["token", "type", "expire"]);
    }
}