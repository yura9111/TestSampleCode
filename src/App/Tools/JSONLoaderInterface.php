<?php

namespace App\Tools;

interface JSONLoaderInterface
{
    /**
     * @param string $url
     * @return Object[]|Object
     * @throws \Exception
     */
    function load(string $url);
}