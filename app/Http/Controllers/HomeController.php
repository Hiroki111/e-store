<?php

namespace App\Http\Controllers;

use App\RecommendedBundle;
use App\RecommendedProduct;
use App\Slide;

class HomeController extends Controller
{
    public function index()
    {
        return view('www.index', [
            'slides'              => Slide::active()->get(),
            'recommendedBundles'  => RecommendedBundle::getBundles(),
            'recommendedProducts' => RecommendedProduct::getProducts(),
        ]);
    }
}
