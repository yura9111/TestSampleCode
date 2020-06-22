<?php

namespace App\Tools;

function round_up ( $value, $precision ) {
    $pow = pow ( 10, $precision );
    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
}

class Format
{
    static function money(float $number): float
    {
        if ($number < 0){
            throw new \Exception("Format::money doesn't work with negative money!");
        }
        if ($number == 0){
            return 0;
        }
        if ($number < 0.01){
            return 0.01;
        }
        $string = strval($number);
        $parts = explode(".", $string);
        $float = 0.0;
        if (count($parts) > 1){
            $float = $parts[1][0] * 10;
            if (strlen($parts[1]) > 1){
                $float += $parts[1][1];
                if (strlen($parts[1]) > 2){
                    $float += 1;
                }
            }
            $float = $float / 100;
        }
        return ($parts[0] + $float);

    }
}