<?php

function getPrice($priceInDecimal)
{
    $price = floatval($priceInDecimal) / 100;

    return number_format($price, 2, ",", " ") . " £";
}
