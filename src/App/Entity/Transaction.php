<?php

namespace App\Entity;

class Transaction
{
    public $bin;
    public $amount;
    public $currency;

    function fromJSON(String $json)
    {
        $obj = json_decode($json);
        if ($obj == null) {
            throw new \Exception("can't decode Transaction entity from JSON");
        }
        foreach ($this as $key => $val) {
            if (isset($obj->$key)) {
                $this->$key = $obj->$key;
            } else {
                throw new \Exception("$key is missing for transaction json");
            }
        }
    }
}