<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Bundle;
use App\Cart;
use App\Country;
use App\Product;
use App\ProductType;
use App\RecommendedBundle;
use App\RecommendedProduct;
use App\SelectedFilter;
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

    public function productType($productTypeId)
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

    public function product($hashedId)
    {
        $product = Product::find(decode_hash($hashedId));

        return view('www.product', [
            'productType'      => ProductType::find($product->product_type_id),
            'product'          => $product,
            'relevantProducts' => Product::getRelevantItems($product->id),
        ]);
    }

    public function bundle($hashedId)
    {
        return view('www.bundle', [
            'bundle' => Bundle::with('products')->find(decode_hash($hashedId)),
        ]);
    }

    public function viewcart()
    {
        return view('www.viewcart', [
            'cart' => new Cart(session('cart')),
        ]);
    }

    public function checkoutOption()
    {
        return view('www.checkoutoption');
    }

    public function payment()
    {
        return view('www.payment', [
            'cart' => new Cart(session('cart')),
        ]);
    }
}
