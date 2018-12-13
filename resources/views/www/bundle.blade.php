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
    <div class="col-sm-4">
      <div style="max-width: 100%;">
        <img style="width: 100%;" src="{{$bundle->src}}">
      </div>
    </div>
    <div class="col-sm-8">
      <div class="row">
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
            <div class="price-des" style="font-size: 12px; margin-left: 5px; margin-top: 7px;">Each</div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card-body text-center">
            <div class="d-flex justify-content-between align-items-center">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="product" data-item-id="{{$bundle->hashed_id}}">-</button>
                </div>
                <input type="number" id="product-{{$bundle->hashed_id}}" min="1" max="50" value="1" style="text-align: center;" class="form-control">
                <div class="input-group-append">
                  <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="product" data-item-id="{{$bundle->hashed_id}}">+</button>
                </div>
              </div>
            </div>
            <div class="input-group">
              <button data-item-type="product" data-item-id="{{$bundle->hashed_id}}" data-item-src="{{$bundle->src}}" type="button" class="btn add-item add-to-cart-button">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3 id="product-details-heading">Product Details</h3>
          <p>{{$bundle->description}}</p>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12">
      <h3>What's included</h3>

    </div>
  </div>
  @include('www.layout.addeditem')
</div>

@endsection
