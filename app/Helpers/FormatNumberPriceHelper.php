<?php

if (!function_exists('formatNumberPrice')) {
    function formatNumberPrice($price) {
        $formattedNumber = number_format($price, 0, ',', ',');
        return $formattedNumber;
    }
}