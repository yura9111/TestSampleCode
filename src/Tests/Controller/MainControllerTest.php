<?php

namespace Tests\Controller;


use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class MainControllerTest extends TestCase
{
    public function testValid()
    {
        $obj = new Transaction();
        $obj->fromJSON('{"bin":"45717360","amount":"100.00","currency":"EUR"}');
        $this->assertEquals($obj->bin, "45717360");
        $this->assertEquals($obj->money->getAmount(), "100.00");
        $this->assertEquals($obj->money->getCurrency(), "EUR");
    }
}