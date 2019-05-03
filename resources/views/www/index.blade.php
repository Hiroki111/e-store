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
    <div class="carousel-item @if($i === 0) active @endif" style="background-image: url({{$slide->src}});">
      <div class="container">
        <div class="carousel-caption text-left">
          <h1 class="outlined-text">{{$slide->title}}</h1>
          <p class="outlined-text">{{$slide->description}}</p>
          <p><a class="btn btn-lg btn-primary" href="/product-type/{{$slide->product_id}}" role="button">MORE</a></p>
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
    <div class="col-lg-4">
      <h2><i class="fa fa-beer" aria-hidden="true"></i></i> Click & Collect</h2>
      <div style="min-height: 60px">
        <p style="margin: 0;">Order online and pick up in store in as little as 60 minutes.</p>
        <p style="margin: 0;"></p>
      </div>
      <p><a style="font-weight: bold; color: red; font-family: 'Arial',Helvetica,sans-serif;" href="/click-and-collect">VIEW DETAILS &raquo;</a></p>
    </div>
    <div class="col-lg-4">
      <h2><i class="fa fa-truck" aria-hidden="true"></i> Delivery Info</h2>
      <div style="min-height: 60px">
        <p style="margin: 0;">FREE domestic delivery on all wine</p>
        <p style="margin: 0;">FREE international delivery on any order over $150</p>
      </div>
      <p><a style="font-weight: bold; color: red; font-family: 'Arial',Helvetica,sans-serif;" href="#" data-toggle="modal" data-target="#modalBingUpdated">VIEW DETAILS &raquo;</a></p>
    </div>
    <div class="col-lg-4">
      <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order &amp; Payment</h2>
      <div style="min-height: 60px">
        <p style="margin: 0;">Online, Phone, In Store</p>
      </div>
      <p><a style="font-weight: bold; color: red; font-family: 'Arial',Helvetica,sans-serif;" href="#" data-toggle="modal" data-target="#modalBingUpdated">VIEW DETAILS &raquo;</a></p>
    </div>
  </div>

  <hr class="" style="margin: 30px 0;">
  <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Special Bundles</h1>
  <div class="row">
    @foreach($recommendedBundles as $bundle)
    @include('www.util.productpanel', ['item' => $bundle, 'type' => 'bundle'])
    @endforeach
  </div>

  <hr class="" style="margin: 30px 0;">
  <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Top Picks</h1>
  <div class="row">
    @foreach($recommendedProducts as $product)
    @include('www.util.productpanel', ['item' => $product, 'type' => 'product'])
    @endforeach
  </div>

  @include('www.layout.addeditem')
</div>

<!-- Modal -->
<div class="modal fade" id="modalBingUpdated" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Sorry, this page is currently unavailable.</p>
      </div>
      <div class="modal-footer" style="border-top: 0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
