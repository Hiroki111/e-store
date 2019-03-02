<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Country;
use App\Product;
use App\ProductType;
use App\SelectedFilter;

class ProductTypeController extends Controller
{
    public function index($productTypeId)
    {
        $sortColumn  = request('sort_by', 'name');
        $sortOrder   = request('order_by', 'asc');
        $priceMin    = explode(',', request('price_min', 0));
        $priceMax    = explode(',', request('price_max', 10000));
        $priceRanges = collect($priceMin)->zip($priceMax);
        $countryIds  = Country::getIdsFromUrlSafeNames(request('country_names', null));
        $brandIds    = Brand::getIdsFromUrlSafeNames(request('brand_names', null));

        $products = Product::where('product_type_id', $productTypeId)
            ->where(function ($query) use ($countryIds) {
                if ($countryIds) {
                    $query->whereIn('country_id', $countryIds);
                }
            })
            ->where(function ($query) use ($brandIds) {
                if ($brandIds) {
                    $query->whereIn('brand_id', $brandIds);
                }
            })
            ->where(function ($query) use ($priceRanges) {
                $priceRanges->each(function ($priceRange, $i) use ($query) {
                    $command = ($i === 0) ? "whereBetween" : "orWhereBetween";
                    $query->$command('price', [$priceRange[0], $priceRange[1]]);
                });
            });

        return view('www.producttype', [
            'productType'    => ProductType::find($productTypeId),
            'selectedFilter' => new SelectedFilter(request()->input()),
            'priceRanges'    => Product::getPriceRanges($products->pluck('id')),
            'countries'      => Country::getWithQtyOfProducts($products->pluck('id')),
            'brands'         => Brand::getWithQtyOfProducts($products->pluck('id')),
            'products'       => $products->orderBy($sortColumn, $sortOrder)->paginate(12),
        ]);
    }
}
