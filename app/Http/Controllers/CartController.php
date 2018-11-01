<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return response()->json(session('cart'), 201);
    }

    public function add()
    {
        $this->validate(request(), [
            'type' => ['required'],
            'qty'  => ['required', 'integer', 'min:0'],
        ]);

        $type = request('type');
        $cart = session('cart');

        if (empty($cart[$type][request('productId')])) {
            $cart[$type][request('productId')] = 0;
        }

        $cart[$type][request('productId')] += request('qty');

        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'type' => ['required'],
            'qty'  => ['required', 'integer', 'min:0'],
        ]);

        $cart                              = session('cart');
        $type                              = request('type');
        $cart[$type][request('productId')] = request('qty');

        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }
}
