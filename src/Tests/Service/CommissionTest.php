<?php

namespace Tests\Service;


use App\Entity\Transaction;
use App\Provider\BinProvider;
use App\Provider\RatesProvider;
use App\Service\Commission;
use Maba\Component\Monetary\Money;
use PHPUnit\Framework\TestCase;

class CommissionTest extends TestCase
{
    public function testEUEuro()
    {
        $transaction = new Transaction();
        $transaction->bin = "12345";
        $transaction->money = new Money("100", "EUR");
        $binProviderMock = $this->createMock(BinProvider::class);
        $ratesProviderMock = $this->createMock(RatesProvider::class);
        $binProviderMock->method("isEu")
            ->willReturn(true);
        $ratesProviderMock->method("get")
            ->willReturn(0);
        $commision = new Commission($binProviderMock, $ratesProviderMock);
        $this->assertEquals($commision->getCommission($transaction)->getAmount(), 1);
    }

    public function testValidNoEUEuro()
    {
        $transaction = new Transaction();
        $transaction->bin = "12345";
        $transaction->money = new Money("100", "EUR");
        $binProviderMock = $this->createMock(BinProvider::class);
        $ratesProviderMock = $this->createMock(RatesProvider::class);
        $binProviderMock->method("isEu")
            ->willReturn(false);
        $ratesProviderMock->method("get")
            ->willReturn(0);
        $commision = new Commission($binProviderMock, $ratesProviderMock);
        $this->assertEquals($commision->getCommission($transaction)->getAmount(), 2);
    }

    public function testValidEUUSD()
    {
        $transaction = new Transaction();
        $transaction->bin = "12345";
        $transaction->money = new Money("100", "EUR");
        $binProviderMock = $this->createMock(BinProvider::class);
        $ratesProviderMock = $this->createMock(RatesProvider::class);
        $binProviderMock->method("isEu")
            ->willReturn(true);
        $ratesProviderMock->method("get")
            ->willReturn(1);
        $commision = new Commission($binProviderMock, $ratesProviderMock);
        $this->assertEquals($commision->getCommission($transaction)->getAmount(), 1);
    }

    public function testValidNoEuUSD()
    {
        $transaction = new Transaction();
        $transaction->bin = "12345";
        $transaction->money = new Money("100", "EUR");
        $binProviderMock = $this->createMock(BinProvider::class);
        $ratesProviderMock = $this->createMock(RatesProvider::class);
        $binProviderMock->method("isEu")
            ->willReturn(false);
        $ratesProviderMock->method("get")
            ->willReturn(1);
        $commision = new Commission($binProviderMock, $ratesProviderMock);
        $this->assertEquals($commision->getCommission($transaction)->getAmount(), 2);
    }
}