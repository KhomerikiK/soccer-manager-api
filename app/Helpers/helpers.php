<?php

if (! function_exists('toBaseUnit')) {
    function toBaseUnit($amount): int
    {
        return $amount * 100;
    }
}

if (! function_exists('fromBaseUnit')) {
    function fromBaseUnit($amount): int
    {
        return $amount / 100;
    }
}
