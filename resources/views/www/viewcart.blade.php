@extends('www.layout.master')
@section('title', 'Checkout - View Cart')
@section('content')
<script type="text/javascript" src="/js/viewcart.js"></script>
<div class="viewcart">
    <div class="viewcart-wrapper">
        <h3 class="font-weight-bold font-arial page-title">View Cart</h3>
        <div class="item-wrapper">
            @foreach($cart as $item)
            <hr />
            <div class="item" id="{{$item->type}}-{{$item->id}}-tr">
                <div class="item-info-wrap">
                    <div class="item-img">
                        <a href="{{$item->url}}"><img src="{{$item->src}}"></a>
                    </div>
                    <div class="item-info">
                        <h5 class="font-weight-bold font-arial"><a class="item-name" href="{{$item->url}}">{{$item->name}}</a></h5>
                        <div class="each-price-wrap">
                            <span class="each-price">Each ${{$item->price}}</span>
                        </div>
                    </div>
                </div>
                <div class="item-checkout-info">
                    <div class="quantity-and-update">
                        <div class="quantity">
                            <span class="input-group-text" id="basic-addon1">Quantity</span>
                            <input type="number" class="form-control item-qty-input" name="{{$item->type}}-{{$item->id}}" data-type="{{$item->type}}" data-id="{{$item->id}}" data-price="{{$item->price}}" min="1" max="50" value="{{$item->qty}}" style="text-align: center; max-width: 70px;">
                        </div>
                        <div class="update-button">
                            <button class="update-item-btn btn" data-type="{{$item->type}}" data-id="{{$item->id}}" style="color: blue; padding: 0; display: none;"><i class="fa fa-cart-plus" aria-hidden="true" style="padding-right: 5px;"></i>Update</button>
                        </div>
                    </div>
                    <div>
                        <div class="price">
                            <p class="font-weight-bold" data-total-price="{{$item->type}}{{$item->id}}">${{$item->total_price}}</p>
                        </div>
                        <div class="remove-button">
                            <button class="remove-item-btn btn" data-type="{{$item->type}}" data-id="{{$item->id}}" style="color: red; padding: 0;"><i class="fa fa-times" aria-hidden="true" style="padding-right: 5px;"></i>Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="botton-heading">
            <h3 id="ground-total" class="font-weight-bold font-arial">Total ${{$cart->getTotalPrice()}}</h3>
        </div>
        <div class="botton-heading">
            <h5 id="total-qty" class="font-weight-bold">{{ $cart->count }} @if($cart->count > 1) items @else item @endif</h5>
        </div>
        <div class="botton-heading">
            <span class="continue-shopping-span"><a href="/" class="viewcart-link">Continue Shopping</a> OR <a href="/checkout-option" class="viewcart-link"><button class="checkout-btn btn font-weight-bold">Checkout</button></a></span>
        </div>
    </div>
</div>
@endsection
