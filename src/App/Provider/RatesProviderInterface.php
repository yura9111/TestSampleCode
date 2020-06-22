<?php

namespace App\Provider;


interface RatesProviderInterface
{
    function get(string $currency): float;
}