<?php

if (! function_exists('cart')) {
    function cart()
    {
        return app('cart');
    }
}

if (! function_exists('formatCurrency')) {
    function formatCurrency(float $price)
    {

        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        return $fmt->format($price);

    }
}
