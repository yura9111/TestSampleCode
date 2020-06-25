<?php

namespace App\Parser;

use App\Entity\Transaction;
use App\Service\CommissionInterface;
use App\Tools\Format;
use App\Tools\FormatInterface;

class ParserTXT
{
    protected $format;
    function __construct(FormatInterface $format)
    {
        $this->format = $format;
    }

    function parse(string $fileName, CommissionInterface $commissionService)
    {
        $rows = explode("\n", file_get_contents($fileName));

        foreach ($rows as $row) {
            $transaction = new Transaction();
            $transaction->fromJSON($row);
            $commission = $commissionService->getCommission($transaction);
            echo $this->format->money($commission);
            print "\n";
        }
    }
}