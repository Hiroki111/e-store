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

        if (empty($cart[$type][request('itemId')])) {
            $cart[$type][request('itemId')] = 0;
        }

        $cart[$type][request('itemId')] += request('qty');

        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }

    public function update($type, $hashedId)
    {
        $this->validate(request(), [
            'qty' => ['required', 'integer', 'min:0'],
        ]);

        $qty  = request('qty');
        $cart = session('cart');

        if (empty($cart[$type][$hashedId])) {
            return response()->json(['The item ID is not found in cart'], 422);
        }

        if ((int) $qty < 1) {
            unset($cart[$type][$hashedId]);
        } else {
            $cart[$type][$hashedId] = (int) request('qty');
        }

        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'type' => ['required'],
            'qty'  => ['required', 'integer', 'min:0'],
        ]);

        $cart                           = session('cart');
        $type                           = request('type');
        $cart[$type][request('itemId')] = request('qty');

        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }

    public function destroy(Request $request)
    {
        $this->validate(request(), [
            'type'   => ['required'],
            'itemId' => ['required'],
        ]);

        $cart   = session('cart');
        $type   = request('type');
        $itemId = request('itemId');

        unset($cart[$type][$itemId]);
        session(['cart' => $cart]);

        return response()->json($cart, 201);
    }
}
