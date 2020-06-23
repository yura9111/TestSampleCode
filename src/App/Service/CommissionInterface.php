<?php

namespace App\Service;

use App\Entity\Transaction;
use Maba\Component\Monetary\Money;

interface CommissionInterface
{
    function getCommission(Transaction $transaction): Money;
}