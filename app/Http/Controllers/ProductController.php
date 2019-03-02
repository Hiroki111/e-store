<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;

class ProductController extends Controller
{
    public function index($hashedId)
    {
        $product = Product::find(decode_hash($hashedId));

        return view('www.product', [
            'productType'      => ProductType::find($product->product_type_id),
            'product'          => $product,
            'relevantProducts' => Product::getRelevantItems($product->id),
        ]);
    }
}
