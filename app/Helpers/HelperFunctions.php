<?php

use App\PseudoCrypt;

if (!function_exists('decode_hash')) {
    function decode_hash($hash)
    {
        return (int) PseudoCrypt::unhash($hash);
    }
}

if (!function_exists('encode_hash')) {
    function encode_hash($value)
    {
        return PseudoCrypt::hash($value);
    }
}
