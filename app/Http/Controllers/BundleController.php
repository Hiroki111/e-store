<?php

namespace App\Http\Controllers;

use App\Bundle;

class BundleController extends Controller
{
    public function index($hashedId)
    {
        return view('www.bundle', [
            'bundle' => Bundle::with('products')->find(decode_hash($hashedId)),
        ]);
    }
}
