<?php

namespace App\Http\Controllers;

use App\Cart;

class ViewCartController extends Controller
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('www.viewcart', [
            'cart' => $this->cart->setItems(session('cart')),
        ]);
    }
}
