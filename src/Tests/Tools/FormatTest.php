<?php

namespace Tests\Tools;

use App\Tools\Format;
use PHPUnit\Framework\TestCase;

class FormatTest extends TestCase
{
    public function testMoney()
    {
        $this->assertEquals("1.1", Format::money(1.1));//common (ceil(number*100))/100 doesn't pass this test
        $this->assertEquals("1", Format::money(1));
        $this->assertEquals("1.01", Format::money(1.01));
        $this->assertEquals("1", Format::money(1.00));
        $this->assertEquals("1", Format::money(0.999));
        $this->assertEquals("1", Format::money(1.000000));
        $this->assertEquals("1", Format::money(0.9999999));
        $this->assertEquals("1", Format::money(0.990000009));
        $this->assertEquals("124.47", Format::money(124.47));
        $this->assertEquals("124.07", Format::money(124.068));
        $this->assertEquals("199.47", Format::money(199.469));
        $this->assertEquals("9784.47", Format::money(9784.470000));
        $this->assertEquals("9784.48", Format::money(9784.4700001));
        $this->assertEquals("9784456", Format::money(9784456));
        $this->assertEquals("9784456.1", Format::money(9784456.1));
        $this->assertEquals("9784456.9", Format::money(9784456.9));
        $this->assertEquals("0.01", Format::money(4.4700001E-11));
        $this->assertEquals("447000010000", Format::money(4.4700001E11));
        $this->assertEquals("0", Format::money(0));
        $this->assertEquals("0", Format::money(-0));
        $this->assertEquals("0", Format::money(+0));
        $this->expectException(\Exception::class);
        Format::money(-4);
    }
}