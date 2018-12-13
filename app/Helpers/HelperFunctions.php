<?php

use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('decode_hash')) {
    function decode_hash($hash)
    {
        return Hashids::decode($hash)[0];
    }
}
