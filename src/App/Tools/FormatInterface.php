<?php

namespace App\Tools;

use Maba\Component\Monetary\Money;

interface FormatInterface
{
    function money(Money $money): string;
}