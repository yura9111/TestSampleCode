<?php

namespace App\Controller;

use App\Parser\ParserTXT;
use App\Provider\BinProvider;
use App\Provider\RatesProvider;
use App\Service\Commission;
use App\Tools\JSONLoader;

class MainController
{
    function mainAction($fileName)
    {
        $commissionService = new Commission(new BinProvider(new JSONLoader()), new RatesProvider(new JSONLoader()));

        $parser = new ParserTXT();
        $parser->parse($fileName, $commissionService);
    }
}