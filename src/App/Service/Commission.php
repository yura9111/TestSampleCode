<?php

namespace App\Service;

use App\Entity\Transaction;
use App\Provider\BinProviderInterface;
use App\Provider\RatesProviderInterface;

class Commission implements CommissionInterface
{
    private $binProvider;
    private $ratesProvider;

    function __construct(BinProviderInterface $binProvider, RatesProviderInterface $ratesProvider)
    {
        $this->binProvider = $binProvider;
        $this->ratesProvider = $ratesProvider;
    }

    function getCommission(Transaction $transaction): float
    {
        $isEu = $this->binProvider->isEu($transaction->bin);

        $rate = $this->ratesProvider->get($transaction->currency);

        $commission = $transaction->amount;
        if ($rate > 0) {
            $commission = $transaction->amount / $rate;
        }

        return $commission * ($isEu ? 0.01 : 0.02);
    }
}