<?php

namespace Tests\Provider;


use App\Provider\BinProvider;
use PHPUnit\Framework\TestCase;

class BinProviderTest extends TestCase
{
    public function testValidEU()
    {
        $jsonString = '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"credit","brand":"Traditional","prepaid":false,"country":{"numeric":"392","alpha2":"FR","name":"Japan","emoji":"🇯🇵","currency":"JPY","latitude":36,"longitude":138},"bank":{"name":"CREDIT SAISON CO., LTD.","url":"corporate.saisoncard.co.jp","phone":"(03)3988-2111"}}';
        $jsonObj = json_decode($jsonString);
        $jsonLoader = $this->createMock(\App\Tools\JSONLoader::class, array("load"));
        $jsonLoader->method("load")
            ->willReturn($jsonObj);
        $binProvider = new BinProvider($jsonLoader);
        $this->assertTrue($binProvider->isEu("3254235"));
    }

    public function testValidNONEU()
    {
        $jsonString = '{"number":{"length":16,"luhn":true},"scheme":"visa","type":"credit","brand":"Traditional","prepaid":false,"country":{"numeric":"392","alpha2":"JP","name":"Japan","emoji":"🇯🇵","currency":"JPY","latitude":36,"longitude":138},"bank":{"name":"CREDIT SAISON CO., LTD.","url":"corporate.saisoncard.co.jp","phone":"(03)3988-2111"}}';
        $jsonObj = json_decode($jsonString);
        $jsonLoader = $this->createMock(\App\Tools\JSONLoader::class, array("load"));
        $jsonLoader->method("load")
            ->willReturn($jsonObj);
        $binProvider = new BinProvider($jsonLoader);
        $this->assertFalse($binProvider->isEu("325423521213"));
    }
}