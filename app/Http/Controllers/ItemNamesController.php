<?php

namespace App\Http\Controllers;

use App\Product;

class ItemNamesController extends Controller
{
    public function index()
    {
        $itemNames = Product::get()->map(function ($item) {
            return $item->name;
        });
        return response()->json($itemNames, 201);
    }
}
