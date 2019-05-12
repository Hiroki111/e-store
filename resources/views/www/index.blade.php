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
    <div class="delivery-order-info">
        <div class="delivery-order-info-item">
            <h2><i class="fa fa-beer" aria-hidden="true"></i></i> Click & Collect</h2>
            <div class="delivery-order-info-description">
                <p>Order online and pick up in store in as little as 60 minutes.</p>
            </div>
            <p class="font-arial"><a href="/click-and-collect">VIEW DETAILS &raquo;</a></p>
        </div>
        <div class="delivery-order-info-item">
            <h2><i class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></i> Delivery Info</h2>
            <div class="delivery-order-info-description">
                <p>FREE domestic delivery on all wine</p>
            </div>
            <p class="font-arial"><a href="/delivery">VIEW DETAILS &raquo;</a></p>
        </div>
        <div class="delivery-order-info-item">
            <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order &amp; Payment</h2>
            <div class="delivery-order-info-description">
                <p>Online, Phone, In Store</p>
            </div>
            <p class="font-arial"><a href="/orderandpayment">VIEW DETAILS &raquo;</a></p>
        </div>
    </div>
    <hr>
    <h1 class="font-arial">Special Bundles</h1>
    <div class="bundle-container">
        @foreach($recommendedBundles as $bundle)
        @include('www.util.productpanel', ['item' => $bundle, 'type' => 'bundle'])
        @endforeach
    </div>
    <hr>
    <h1 class="font-arial">Top Picks</h1>
    <div class="product-container">
        @foreach($recommendedProducts as $product)
        @include('www.util.productpanel', ['item' => $product, 'type' => 'product'])
        @endforeach
    </div>
    @include('www.layout.addeditem')
    @include('www.layout.cartbutton')
</div>
@endsection
