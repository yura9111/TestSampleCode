<?php

namespace App\Provider;

use App\Tools\JSONLoaderInterface;

class BinProvider implements BinProviderInterface
{
    protected $jsonLoader;
    protected $url = "https://lookup.binlist.net/";
    protected $EUCountries = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'];

    function __construct(JSONLoaderInterface $jsonLoader)
    {
        $this->jsonLoader = $jsonLoader;
    }

    function isEu(string $bin): bool
    {
        $r = $this->jsonLoader->load($this->url . $bin);
        return in_array($r->country->alpha2, $this->EUCountries);
    }
}