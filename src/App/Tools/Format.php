<?php

namespace App\Tools;

use Maba\Component\Math\BcMath;
use Maba\Component\Math\Math;
use Maba\Component\Math\NumberValidator;
use Maba\Component\Monetary\Factory\MoneyFactory;
use Maba\Component\Monetary\Information\MoneyInformationProvider;
use Maba\Component\Monetary\Money;
use Maba\Component\Monetary\MoneyCalculator;
use Maba\Component\Monetary\Validation\MoneyValidator;

class Format implements FormatInterface
{
    function money(Money $money): string
    {
        $math = new Math(new BcMath());
        $informationProvider = new MoneyInformationProvider();
        $factory = new MoneyFactory($math, new MoneyValidator($math, $informationProvider, new NumberValidator()));
        $calculator = new MoneyCalculator($math, $factory, $informationProvider);
        $string = $calculator->ceil($money)->getAmount();
        if (strpos($string, ".") !== false) {
            $string = rtrim(rtrim($string, "0"), ".");
        }
        return $string;
    }
}