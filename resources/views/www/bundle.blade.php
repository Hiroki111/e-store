@extends('www.layout.master')

@section('title', $bundle->name)

@section('content')

<script type="text/javascript" src="/js/product.js"></script>
<div id="breadcrumbs" class="container">
	<ul>
		<li>
			<a href="/">Home</a>
			<span>›</span>
		</li>
    <li>{{$bundle->name}}</li>
  </ul>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div style="max-width: 100%; display: flex;">
        <img style="max-height: 300px; margin: auto;" src="{{$bundle->src_large}}">
      </div>
    </div>
    <div class="col-sm-8">
      <h1 id="product-name-heading">{{$bundle->name}}</h1>
      <div class="product-tile-price-big" style="color: #D2232A; display: flex;">
        <div class="price-product-new">
          <span class="price" style="font-size: 22px; font-weight: 900; vertical-align: top;">
            <span class="currency" style="font-size: 12px;">$</span>
            {{$bundle->dollars}}
            <span class="cents" style="font-size: 12px;">.{{$bundle->cents}}</span>
          </span>
        </div>
        <div class="price-des" style="font-size: 12px; margin-left: 5px; margin-top: 7px;">Each Bundle</div>
      </div>
      <h5 style="font-weight: bold;">Free domestic delivery</h5>
    </div>
    <div class="col-sm-4">
      <div class="card-body text-center">
        <div class="d-flex justify-content-between align-items-center">
          <div class="input-group">
            <div class="input-group-prepend">
              <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="bundle" data-item-id="{{$bundle->hashed_id}}">-</button>
            </div>
            <input type="number" id="bundle-{{$bundle->hashed_id}}" min="1" max="50" value="1" style="text-align: center;" class="form-control">
            <div class="input-group-append">
              <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="bundle" data-item-id="{{$bundle->hashed_id}}">+</button>
            </div>
          </div>
        </div>
        <div class="input-group">
          <button data-item-type="bundle" data-item-id="{{$bundle->hashed_id}}" data-item-src="{{$bundle->src}}" type="button" class="btn add-item add-to-cart-button">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12">
      <h4 id="product-details-heading">Product Details</h4>
      <p>{{$bundle->description}}</p>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12">
      <h4 style="font-weight: bold; color: red;">What's included</h4>
      @foreach($bundle->getProductList() as $product)
      <div class="row">
        <div class="col-sm-2" style="display: flex;">
          <img style="max-width: 125px; max-height: 125px; margin: auto;" src="{{$product->src}}">
        </div>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-12">
              <p class="font-weight-bold">{{$product->qty}} {{$product->packaging}} of {{$product->name}} {{$product->volume}}ml</p>
              <p>{{$product->description}}</p>
            </div>
            <div class="col-sm-6">
              <ul class="product-details-ul">
                <li>Alcohol Content <span>{{$product->alcohol}}%</span></li>
                <li>Packaging <span>{{ucfirst($product->packaging)}}</span></li>
              </ul>
            </div>
            <div class="col-sm-6">
              <ul class="product-details-ul">
                <li>Brand <span>{{$product->brand->name}}</span></li>
                <li>Origin <span>{{$product->country->name}}</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr>
      @endforeach
    </div>
  </div>
  @include('www.layout.addeditem')
</div>

@endsection
