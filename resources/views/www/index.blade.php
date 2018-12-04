@extends('www.layout.master')

@section('title', 'Top')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    @foreach($slides as $i => $slide)
    <div class="carousel-item @if($i === 0) active @endif">
      <img src="{{$slide->src}}" alt="{{$slide->title}}">
      <div class="container">
        <div class="carousel-caption text-left">
          <h1 class="outlined-text">{{$slide->title}}</h1>
          <p class="outlined-text">{{$slide->description}}</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">MORE</a></p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="container marketing">
  <div class="row">
    <div class="col-lg-6">
      <h2><i class="fa fa-truck" aria-hidden="true"></i> Delivery Info</h2>
      <div style="min-height: 60px">
        <p style="margin: 0;">FREE domestic delivery on all wine</p>
        <p style="margin: 0;">FREE international delivery on any order over $150</p>
      </div>
      <p><a class="btn btn-secondary" href="#" role="button">View Details &raquo;</a></p>
    </div>
    <div class="col-lg-6">
      <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order &amp; Payment</h2>
      <div style="min-height: 60px">
        <p style="margin: 0;">Online, Phone, In Store</p>
      </div>
      <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
    </div>
  </div>

  <hr class="featurette-divider">
  <h1>Popular Bundles in this month</h1>
  <div class="row">
    @foreach($recommendedBundles as $bundle)
    <div class="col-md-3">
      <div class="card mb-3 shadow-sm">
        <img class="card-img-top" src="{{$bundle->src}}">
        <div class="card-body text-center">
          <h5 class="card-text" style="font-weight: bold;">{{$bundle->name}}</h5>
          <div class="flex-wrapper flex-wrapper-first">
            <div class="product-tile-price-big" style="color: #D2232A; display: flex;">
              <div class="price-bundle-new">
                <span class="price" style="font-size: 22px; font-weight: 900; vertical-align: top;">
                  <span class="currency" style="font-size: 12px;">$</span>
                  {{$bundle->dollars}}
                  <span class="cents" style="font-size: 12px;">.{{$bundle->sents}}</span>
                </span>
              </div>
              <div class="price-des" style="font-size: 12px; margin-left: 5px; margin-top: 7px;">Each</div>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="bundle" data-item-id="{{$bundle->id}}">-</button>
              </div>
              <input type="number" id="bundle-{{$bundle->id}}" min="1" max="50" value="1" style="text-align: center;" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="bundle" data-item-id="{{$bundle->id}}" >+</button>
              </div>
            </div>
          </div>
          <div class="input-group">
            <button data-item-type="bundle" data-item-id="{{$bundle->id}}" data-item-src="{{$bundle->src}}" type="button" class="btn add-item add-to-cart-button" >Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <hr class="featurette-divider">
  <h1>Products of This Month</h1>
  <div class="row">
    @foreach($recommendedProducts as $product)
    <div class="col-md-3">
      <div class="card mb-3 shadow-sm">
          <a href="/product/{{$product->hashed_id}}"><img class="card-img-top" src="{{$product->src}}"></a>
        <div class="card-body text-center">
          <h5 class="card-text" style="font-weight: bold;">{{$product->name}}</h5>
          <div class=" flex-wrapper flex-wrapper-first">
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
    @endforeach
  </div>

  @include('www.layout.addeditem')
</div>
@endsection
