<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return response()->json(session('cart'), 201);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'type' => ['required'],
            'qty'  => ['required', 'integer', 'min:0'],
        ]);

        $cart = session('cart');
        $type = request('type');
        if ($type === 'product') {
            $cart['products'][request('productId')] = request('qty');
        }

        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }
}
