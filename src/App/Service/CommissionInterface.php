<?php

namespace App\Service;

use App\Entity\Transaction;

interface CommissionInterface
{
    function getCommission(Transaction $transaction): float;
}