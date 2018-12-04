<?php

namespace App\Http\ViewComposers;

use App\ProductType;
use Illuminate\View\View;

class ProductTypes
{
    protected $productTypes;

    public function __construct(ProductType $productTypes)
    {
        $this->productTypes = $productTypes;
    }

    public function compose(View $view)
    {
        $view->with('productTypes', $this->productTypes->all());
    }
}
