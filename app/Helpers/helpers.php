<?php

if (! function_exists('toBaseUnit')) {
    function toBaseUnit($amount): int
    {
        return $amount * 100;
    }
}
