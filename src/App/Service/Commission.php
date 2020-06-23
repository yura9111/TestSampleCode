<?php

namespace App\Service;

use App\Entity\Transaction;
use App\Provider\BinProviderInterface;
use App\Provider\RatesProviderInterface;
use Maba\Component\Math\BcMath;
use Maba\Component\Math\Math;
use Maba\Component\Math\NumberValidator;
use Maba\Component\Monetary\Factory\MoneyFactory;
use Maba\Component\Monetary\Information\MoneyInformationProvider;
use Maba\Component\Monetary\Money;
use Maba\Component\Monetary\MoneyCalculator;
use Maba\Component\Monetary\Validation\MoneyValidator;

class Commission implements CommissionInterface
{
    private $binProvider;
    private $ratesProvider;

    function __construct(BinProviderInterface $binProvider, RatesProviderInterface $ratesProvider)
    {
        $this->binProvider = $binProvider;
        $this->ratesProvider = $ratesProvider;
    }

    function getCommission(Transaction $transaction): Money
    {
        $isEu = $this->binProvider->isEu($transaction->bin);

        $rate = $this->ratesProvider->get($transaction->money->getCurrency());

        $math = new Math(new BcMath());
        $informationProvider = new MoneyInformationProvider();
        $factory = new MoneyFactory($math, new MoneyValidator($math, $informationProvider, new NumberValidator()));
        $calculator = new MoneyCalculator($math, $factory, $informationProvider);
        $commission = $transaction->money;
        if ($rate > 0) {
            $commission = $calculator->div($transaction->money, $rate);
        }
        $commission = new Money($commission->getAmount(), "EUR");
        return $calculator->mul($commission, $isEu ? 0.01 : 0.02);
    }
}