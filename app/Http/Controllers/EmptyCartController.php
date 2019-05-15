<?php

namespace App\Http\Controllers;

class EmptyCartController extends Controller
{
    public function index()
    {
        return view('www.emptycart');
    }
}
