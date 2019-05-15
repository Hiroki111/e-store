@extends('www.layout.master')
@section('title', 'Checkout - View Cart')
@section('content')
<div class="container empty-cart">
    <div class="row">
        <div class="col-10 offset-md-1 message-area">
            <h3 class="font-weight-bold font-arial">View Cart</h3>
            <p>Your shopping cart is empty.</p>
        </div>
        <hr>
        <div class="col-12 button-area">
            <span><a href="/" class="viewcart-link">Continue Shopping</a></span>
        </div>
    </div>
</div>
@endsection
