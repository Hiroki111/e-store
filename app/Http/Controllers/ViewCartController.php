<?php

namespace App\Http\Controllers;

use App\Cart;

class ViewCartController extends Controller
{
    public function index()
    {
        return view('www.viewcart', [
            'cart' => new Cart(session('cart')),
        ]);
    }
}
