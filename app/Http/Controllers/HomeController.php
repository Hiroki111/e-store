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
        $sortColumn  = request('sort_by', 'name');
        $sortOrder   = request('order_by', 'asc');
        $priceMin    = explode(',', request('price_min', 0));
        $priceMax    = explode(',', request('price_max', 10000));
        $priceRanges = collect($priceMin)->zip($priceMax);

        $products = Product::where('product_type_id', $id)
            ->where(function ($query) use ($priceRanges) {
                $priceRanges->each(function ($priceRange, $i) use ($query) {
                    $command = ($i === 0) ? "whereBetween" : "orWhereBetween";
                    $query->$command('price', [$priceRange[0], $priceRange[1]]);
                });
            })
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(9);

        return view('www.producttype', [
            'productTypes' => ProductType::all(),
            'productType'  => ProductType::find($id),
            'priceRanges'  => Product::getPriceRanges($id),
            'countries'    => [],
            'products'     => $products,
        ]);
    }
}
