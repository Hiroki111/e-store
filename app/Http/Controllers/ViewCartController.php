<?php

namespace App\Http\Controllers;

use App\Cart;

class ViewCartController extends Controller
{
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart(session('cart'));
    }

    public function index()
    {
        return view('www.viewcart', [
            'cart' => $this->cart,
        ]);
    }
}
