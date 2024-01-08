<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('generateRandomOTP')) {
    function generateRandomOTP()
    {
        return (rand(100000, 999999));
    }
}
