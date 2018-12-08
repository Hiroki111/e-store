@extends('www.layout.master')

@section('title', $product->name)

@section('content')

<div id="breadcrumbs" class="container">
	<ul>
		<li>
			<a href="/">Home</a>
			<span>›</span>
		</li>
		<li>
			<a href="/product-type/{{$productType->id}}">{{$productType->name}}</a>
			<span>›</span>
		</li>
    <li>{{$product->name}}</li>
  </ul>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div style="max-width: 100%;">
        <img class="" style="width: 100%;" src="{{$product->src}}">
      </div>
    </div>
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-8">
          <h1 id="product-name-heading">{{$product->name}}</h1>
          <h4 style="font-weight: bold;">@if(isset($product->brand)){{$product->brand->name}} @endif{{$product->volume}}ml</h4>
          <div class="product-tile-price-big" style="color: #D2232A; display: flex;">
            <div class="price-product-new">
              <span class="price" style="font-size: 22px; font-weight: 900; vertical-align: top;">
                <span class="currency" style="font-size: 12px;">$</span>
                {{$product->dollars}}
                <span class="cents" style="font-size: 12px;">.{{$product->sents}}</span>
              </span>
            </div>
            <div class="price-des" style="font-size: 12px; margin-left: 5px; margin-top: 7px;">Each</div>
          </div>
          @if($product->limit_per_checkout > 0)
          <h5>Limit of {{$product->limit_per_checkout}} Per Cart</h5>
          @endif
        </div>
        <div class="col-sm-4">
          <div class="card-body text-center">
            <div class="d-flex justify-content-between align-items-center">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="product" data-item-id="{{$product->hashed_id}}">-</button>
                </div>
                <input type="number" id="product-{{$product->hashed_id}}" min="1" max="50" value="1" style="text-align: center;" class="form-control">
                <div class="input-group-append">
                  <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="product" data-item-id="{{$product->hashed_id}}" >+</button>
                </div>
              </div>
            </div>
            <div class="input-group">
              <button data-item-type="product" data-item-id="{{$product->hashed_id}}" data-item-src="{{$product->src}}" type="button" class="btn add-item add-to-cart-button" >Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <h3>Product Details</h3>
        <p>{{$product->description}}</p>
      </div>

    </div>
  </div>
  @include('www.layout.addeditem')
</div>

@endsection
