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
        $cart = $this->cart->setItems(session('cart'));

        if ($cart->isEmpty()) {
            return redirect("/empty-cart");
        }

        return view('www.viewcart', [
            'cart' => $cart,
        ]);
    }
}
