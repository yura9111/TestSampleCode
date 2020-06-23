<?php

namespace Tests\Tools;

use App\Tools\Format;
use Maba\Component\Monetary\Money;
use PHPUnit\Framework\TestCase;

class FormatTest extends TestCase
{
    public function testMoney()
    {
        $this->assertEquals("1.1", Format::money(new Money("1.1", "EUR")));//common (ceil(number*100))/100 doesn't pass this test
        $this->assertEquals("1", Format::money(new Money("1.00000000000", "EUR")));
        $this->assertEquals("1.01", Format::money(new Money("1.01", "EUR")));
        $this->assertEquals("1", Format::money(new Money("1.00", "EUR")));
        $this->assertEquals("1", Format::money(new Money("0.999", "EUR")));
        $this->assertEquals("1", Format::money(new Money("0.9999999999", "EUR")));
        $this->assertEquals("1", Format::money(new Money("0.99990000000099", "EUR")));
        $this->assertEquals("124.47", Format::money(new Money("124.47", "EUR")));
        $this->assertEquals("124.07", Format::money(new Money("124.06800", "EUR")));
        $this->assertEquals("9784.47", Format::money(new Money("9784.470000", "EUR")));
        $this->assertEquals("9784.48", Format::money(new Money("9784.4700001", "EUR")));
        $this->assertEquals("978445600000000000000", Format::money(new Money("978445600000000000000", "EUR")));
        $this->assertEquals("978445600000000000000.1", Format::money(new Money("978445600000000000000.1", "EUR")));
        $this->assertEquals("0", Format::money(new Money("0", "EUR")));
    }
}