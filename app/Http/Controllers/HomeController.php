<?php

namespace App\Http\Controllers;

use App\Country;
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

    public function productType($productTypeId)
    {
        $sortColumn  = request('sort_by', 'name');
        $sortOrder   = request('order_by', 'asc');
        $priceMin    = explode(',', request('price_min', 0));
        $priceMax    = explode(',', request('price_max', 10000));
        $priceRanges = collect($priceMin)->zip($priceMax);
        $countryIds  = Country::getIdsFromUrlSafeNames(request('country_names', null));

        $products = Product::where('product_type_id', $productTypeId)
            ->where(function ($query) use ($countryIds) {
                if ($countryIds) {
                    $query->whereIn('country_id', $countryIds);
                }
            })
            ->where(function ($query) use ($priceRanges) {
                $priceRanges->each(function ($priceRange, $i) use ($query) {
                    $command = ($i === 0) ? "whereBetween" : "orWhereBetween";
                    $query->$command('price', [$priceRange[0], $priceRange[1]]);
                });
            });

        return view('www.producttype', [
            'productTypes' => ProductType::all(),
            'productType'  => ProductType::find($productTypeId),
            'priceRanges'  => Product::getPriceRanges($products->pluck('id')),
            'countries'    => Country::getWithQtyOfProducts($products->pluck('id')),
            'products'     => $products->orderBy($sortColumn, $sortOrder)
                ->paginate(12),
        ]);
    }
}
