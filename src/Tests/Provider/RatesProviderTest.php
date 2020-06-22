<?php

namespace Tests\Provider;


use App\Provider\RatesProvider;
use PHPUnit\Framework\TestCase;

class RatesProviderTest extends TestCase
{
    public function testValid()
    {
        $jsonString = '{"rates":{"CAD":1.5209,"HKD":8.6889,"ISK":154.6,"PHP":56.133,"DKK":7.4554,"HUF":345.44,"CZK":26.683,"AUD":1.6261,"RON":4.8428,"SEK":10.567,"IDR":15927.67,"INR":85.352,"BRL":6.0029,"RUB":77.6565,"HRK":7.5665,"JPY":119.77,"THB":34.765,"CHF":1.0656,"SGD":1.5623,"PLN":4.4516,"BGN":1.9558,"TRY":7.6887,"CNY":7.9332,"NOK":10.7135,"NZD":1.7403,"ZAR":19.444,"USD":1.121,"MXN":25.3126,"ILS":3.862,"GBP":0.90505,"KRW":1353.53,"MYR":4.7854},"base":"EUR","date":"2020-06-19"}';
        $jsonObj = json_decode($jsonString);
        $jsonLoader = $this->createMock(\App\Tools\JSONLoader::class, array("load"));
        $jsonLoader->expects($this->once())
            ->method("load")
            ->willReturn($jsonObj);
        $ratesProvoder = new RatesProvider($jsonLoader);
        $this->assertEquals($ratesProvoder->get("EUR"), 0);
        $this->assertEquals($ratesProvoder->get("USD"), 1.121);
    }
}