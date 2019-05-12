@extends('www.layout.master')
@section('title', $productType->name)
@section('content')
<script type="text/javascript" src="/js/producttype.js"></script>
<div id="breadcrumbs" class="container">
    <ul>
        <li>
            <a href="/">Home</a>
            <span>›</span>
        </li>
        <li>{{$productType->name}}</li>
    </ul>
</div>
<div class="container product-type">
    <div class="product-type-wrapper">
        <div class="filter-column">
            @if(!$selectedFilter->isEmpty())
            <div class="selected-filter">
                <h5 class="font-weight-bold">You have chosen:</h5>
                @foreach($selectedFilter as $category => $items)
                <hr>
                <h6 class="font-weight-bold">{{ $category }}<i class="pull-right remove-selected-filter fa fa-times" data-remove-category="{{ $category }}"></i></h6>
                <ul>
                    @foreach($items as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @endforeach
            </div>
            @endif
            <div class="filter-items">
                <div class="product-filter">
                    <div class="row no-gutters filter-header">
                        <div class="col-8">
                            <h4 class="font-weight-bold">Filter</h4>
                        </div>
                        <div class="col-4">
                            <button id="apply-filter-btn" class="btn btn-danger pull-right">Apply</button>
                        </div>
                    </div>
                    <hr>
                    <div class="filter-body">
                        <div class="price-range">
                            <div class="price-range-heading-wrapper">
                                <h5 class="filter-keyword font-weight-bold" data-filter-keyword="price-range">Price Range<i class="pull-right fa fa-minus"></i></h5>
                            </div>
                            <ul id="price-range-ul">
                                @foreach($priceRanges as $priceRange)
                                <li>
                                    <label>
                                        <input type="checkbox" class="price-range-checkbox" data-price-min="{{ $priceRange->min }}" data-price-max="{{ $priceRange->max }}">
                                        ${{ $priceRange->min }} - ${{ $priceRange->max }}
                                        <span>({{ $priceRange->qty }})</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="country">
                            <div class="country-heading-wrapper">
                                <h5 class="filter-keyword font-weight-bold" data-filter-keyword="country">Country<i class="pull-right fa fa-plus"></i></h5>
                            </div>
                            <ul id="country-ul">
                                @foreach($countries as $country)
                                <li>
                                    <label>
                                        <input type="checkbox" class="country-checkbox" data-country-name="{{ $country->url_safe_name }}">
                                        {{ $country->name }}
                                        <span>({{ $country->qty }})</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="brand">
                            <h5 class="filter-keyword font-weight-bold" data-filter-keyword="brand">Brand<i class="pull-right fa fa-plus"></i></h5>
                            <ul id="brand-ul">
                                @foreach($brands as $brand)
                                <li>
                                    <label>
                                        <input type="checkbox" class="brand-checkbox" data-brand-name="{{ $brand->url_safe_name }}">
                                        {{ $brand->name }}
                                        <span>({{ $brand->qty }})</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item-column">
            <h1 id="selected-product-type" class="font-weight-bold text-uppercase">{{$productType->name}}</h1>
            <div class="row no-gutters sort-items-wrapper">
                <div class="col-2 sort-by">Sort By</div>
                <div class="col-4">
                    <select id="sort-items" class="custom-select">
                        <option data-column="name" data-order="asc">Name (A - Z)</option>
                        <option data-column="name" data-order="desc">Name (Z - A)</option>
                        <option data-column="price" data-order="asc">Price (Low to High)</option>
                        <option data-column="price" data-order="desc">Price (High to Low)</option>
                    </select>
                </div>
            </div>
            <div class="row no-gutters products-found">{{$products->total()}} products found</div>
            <div class="row">
                @foreach($products as $product)
                <div class="item">
                    <div class="card mb-4 shadow-sm">
                        <a href="/product/{{$product->hashed_id}}">
                            <div class="card-img-frame">
                                <img class="card-img-top" src="{{$product->src}}">
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-text">{{$product->name}}</h5>
                            <div class="flex-wrapper flex-wrapper-first">
                                <div class="product-tile-price-big">
                                    <div class="price-bundle-new">
                                        <span class="price">
                                            <span class="currency">$</span>
                                            {{$product->dollars}}
                                            <span class="cents">.{{$product->cents}}</span>
                                        </span>
                                    </div>
                                    <div class="price-des">Each</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="product" data-item-id="{{$product->hashed_id}}">-</button>
                                    </div>
                                    <input type="number" id="product-{{$product->hashed_id}}" min="1" max="50" value="1" class="form-control add-item-counter">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="product" data-item-id="{{$product->hashed_id}}">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <button data-item-type="product" data-item-id="{{$product->hashed_id}}" data-item-src="{{$product->src}}" type="button" class="btn add-item add-to-cart-button">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="product-type-pagination">{{ $products->links() }}</div>
        </div>
    </div>
    @include('www.layout.addeditem')
    @include('www.layout.cartbutton')
</div>
@endsection
