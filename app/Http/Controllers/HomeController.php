<?php

namespace App\Http\Controllers;

use App\ProductType;
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
            'productTypes'        => ProductType::all(),
        ]);
    }

    public function productType($id)
    {
        return view('www.producttype', [
            'slides'              => Slide::active()->get(),
            'recommendedBundles'  => RecommendedBundle::getBundles(),
            'recommendedProducts' => RecommendedProduct::getProducts(),
            'productTypes'        => ProductType::all(),
        ]);
    }
}
