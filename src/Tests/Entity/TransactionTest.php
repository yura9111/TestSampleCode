<?php

namespace Tests\Entity;


use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testCorrect()
    {
        $obj = new Transaction();
        $obj->fromJSON('{"bin":"45717360","amount":"100.00","currency":"EUR"}');
        $this->assertEquals($obj->bin, "45717360");
        $this->assertEquals($obj->amount, "100.00");
        $this->assertEquals($obj->currency, "EUR");
    }

    public function testWrongJson()
    {
        $obj = new Transaction();
        $this->expectException("Exception");
        $obj->fromJSON('{"bin":"45717360","amount":"100.00","currency":"EUR"');
    }

    public function testMissingJson()
    {
        $obj = new Transaction();
        $this->expectException("Exception");
        $obj->fromJSON('{"bin":"45717360","amount":"100.00"}');
    }
}