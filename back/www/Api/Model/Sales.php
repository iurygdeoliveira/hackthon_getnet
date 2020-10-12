<?php

namespace Api\Model;

use CoffeeCode\DataLayer\DataLayer;

class Sales extends Datalayer
{
    public function __construct()
    {
        parent::__construct("sales", ["name", "description", "amount"]);
    }
}
