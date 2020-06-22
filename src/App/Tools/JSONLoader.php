<?php

namespace App\Tools;

class JSONLoader implements JSONLoaderInterface
{
    /**
     * @param string $url
     * @return Object[]|Object
     * @throws \Exception
     */
    function load(string $url)
    {
        $binResults = file_get_contents($url);
        if (!$binResults)
            throw new \Exception("can't get response from {$url}");
        $ar = json_decode($binResults);
        if ($ar == null) {
            throw new \Exception("can't decode response from {$url}");
        }
        return $ar;
    }
}