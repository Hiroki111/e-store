@extends('www.layout.master')
@section('title', 'Top')
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="max-width: 1140px; width: 100%; margin: 0 auto 30px auto;">
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
    <hr style="margin: 15px 0 30px 0;">
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
    <!-- Pop up for notifying that this is an imaginary shopping site-->
    <div id="popup" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style='font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;'>
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold;">About this site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="font-wight-bold">Dear visitor</p>
                    <p>This is an imaginary shopping web site which was developed as a hobby project. You can play around with this web site, but the order won't be actually delivered (and of course you won't be charged).</p>
                    <p>The developer's information can be found from <a href="https://github.com/Hiroki111" target="_blank">here</a>.</p>
                    <br />
                    <p>当サイトは趣味のプロジェクトとして開発されたものです。当サイトから注文された品物は、実際に指定された住所へ発送されることはありません。（料金の請求もされません。）</p>
                    <p>開発者の情報は<a href="https://github.com/Hiroki111" target="_blank">こちら</a>から。</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @include('www.layout.addeditem')
    @include('www.layout.cartbutton')
</div>
@endsection
