<?php

namespace App\Parser;

use App\Entity\Transaction;
use App\Service\CommissionInterface;
use App\Tools\Format;

class ParserTXT
{
    function parse(string $fileName, CommissionInterface $commissionService)
    {
        $rows = explode("\n", file_get_contents($fileName));

        foreach ($rows as $row) {
            $transaction = new Transaction();
            $transaction->fromJSON($row);
            $commission = $commissionService->getCommission($transaction);
            echo Format::money($commission);
            print "\n";
        }
    }
}