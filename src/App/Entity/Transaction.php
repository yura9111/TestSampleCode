<?php

namespace App\Entity;

use Maba\Component\Monetary\Money;

class Transaction
{
    public $bin;
    /**
     * @var Money
     */
    public $money;

    function fromJSON(String $json)
    {
        $obj = json_decode($json);
        if ($obj == null) {
            throw new \Exception("can't decode Transaction entity from JSON");
        }
        if (!isset($obj->bin)) {
            throw new \Exception("bin is missing for transaction json");
        }
        if (!isset($obj->amount)) {
            throw new \Exception("amount is missing for transaction json");
        }
        if (!isset($obj->currency)) {
            throw new \Exception("currency is missing for transaction json");
        }
        $this->bin = $obj->bin;
        $this->money = new Money($obj->amount, $obj->currency);
    }
}