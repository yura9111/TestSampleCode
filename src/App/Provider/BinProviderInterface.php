<?php

namespace App\Provider;


interface BinProviderInterface
{
    function isEu(string $bin): bool;
}