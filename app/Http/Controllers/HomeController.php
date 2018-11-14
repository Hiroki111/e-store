<?php

namespace App\Http\Controllers;

use App\Product;
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
        $sortColumn = request('sort_by', 'name');
        $sortOrder  = request('order_by', 'asc');
        $priceMin   = request('price_min', 0);
        $priceMax   = request('price_max', 100000);
        $products   = Product::where('product_type_id', $id)
            ->whereBetween('price', [$priceMin, $priceMax])
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(12);

        return view('www.producttype', [
            'productTypes' => ProductType::all(),
            'productType'  => ProductType::find($id),
            'priceRanges'  => Product::getPriceRanges($id),
            'countries'    => [],
            'products'     => $products,
        ]);
    }
}
