<?php

namespace App\Provider;

use App\Tools\JSONLoaderInterface;

class RatesProvider implements RatesProviderInterface
{
    protected $jsonLoader;
    protected $cache;
    protected $url = 'https://api.exchangeratesapi.io/latest';

    function __construct(JSONLoaderInterface $jsonLoader)
    {
        $this->jsonLoader = $jsonLoader;
    }

    function get(string $currency): float
    {
        if ($this->cache == null) {
            $this->cache = $this->jsonLoader->load($this->url);
        }
        if (isset($this->cache->rates->$currency)) {
            return $this->cache->rates->$currency;
        } else {
            if ($this->cache->base == $currency) {
                return 0;
            }
            throw new \Exception("currency {$currency} not found in cache");
        }
    }
}