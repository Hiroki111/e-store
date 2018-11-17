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

<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <div style="border: 1px solid #c9c9c9; border-radius: 4px; padding-left: 16px; padding-right: 16px;">
        <div id="product-filter">
        <div class="row no-gutters" style="margin-top: 16px;">
            <div class="col-8" style="margin-top: 10px;">
              <h4 class="font-weight-bold">Filter</h4>
            </div>
            <div class="col-4">
              <button id="apply-filter-btn" class="btn btn-danger pull-right">Apply</button>
            </div>
          </div>
          <hr>
          <div>
            <div>
              <h5 class="font-weight-bold">Price Range</h5>
              <ul>
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
            <div>
              <h5 class="font-weight-bold">Country</h5>
              <ul>
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
            <div>
              <h5 class="font-weight-bold">Brand</h5>
              <ul>
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
            <div>
              <h5 class="font-weight-bold">Sweetness</h5>
              <ul>
                <li>
                  <label>
                    <input type="checkbox" name="">
                    Very Dry
                    <span>()</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="">
                    Off Dry
                    <span>()</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="">
                    Medium
                    <span>()</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="">
                    Sweet
                    <span>()</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="">
                    Very Sweet
                    <span>()</span>
                  </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-9">
      <h1 class="font-weight-bold text-uppercase">{{$productType->name}}</h1>
      <div class="row no-gutters" style="margin: 10px 0 15px 0;">
        <div class="col-1" style="padding: 0.375rem 0 0.375rem 0;">Sort By</div>
        <div class="col-4">
          <select id="sort-items" class="custom-select">
            <option data-column="name" data-order="asc" >Name (A - Z)</option>
            <option data-column="name" data-order="desc" >Name (Z - A)</option>
            <option data-column="price" data-order="asc" >Price (Low to High)</option>
            <option data-column="price" data-order="desc" >Price (High to Low)</option>
          </select>
        </div>
      </div>
      <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="{{$product->src}}">
            <div class="card-body text-center">
              <h5 class="card-text" style="font-weight: bold;">{{$product->name}}</h5>
              <div class="flex-wrapper flex-wrapper-first">
                <div class="product-tile-price-big" style="color: #D2232A; display: flex;">
                  <div class="price-bundle-new">
                    <span class="price" style="font-size: 22px; font-weight: 900; vertical-align: top;">
                      <span class="currency" style="font-size: 12px;">$</span>
                      {{$product->dollars}}
                      <span class="cents" style="font-size: 12px;">.{{$product->sents}}</span>
                    </span>
                  </div>
                  <div class="price-des" style="font-size: 12px; margin-left: 5px; margin-top: 7px;">Each</div>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="product" data-item-id="{{$product->id}}">-</button>
                  </div>
                  <input type="number" id="product-{{$product->id}}" min="1" max="50" value="1" style="text-align: center;" class="form-control">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="product" data-item-id="{{$product->id}}" >+</button>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <button data-item-type="product" data-item-id="{{$product->id}}" data-item-src="{{$product->src}}" type="button" class="btn add-item add-to-cart-button" >Add to Cart</button>
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
</div>

@endsection
