@extends('www.layout.master')
@section('title', 'Order Confirmation')
@section('content')
<div class="container">
    <div class="row" style="padding-top: 40px;">
        <div class="col-md-8">
            <div style="margin-bottom: 1rem;">
                <a href="/confirmation/{{$order->hashedId}}/pdf" target="_blank" style="float: right;">Print invoice</a>
                <h2 class="font-weight-bold">Thank you for shopping with us!</h2>
                <h2 class="font-weight-bold">Your order has been placed.</h2>
            </div>
            <div>
                <p class="font-weight-bold">We received your order <span style="color: #3490dc;">{{$order->confirmation_number}}</span> and now it is in process.</p>
                <p class="font-weight-bold">Order Confirmation Email</p>
                <p>We've sent you an order confirmation email.</p>
                <p class="font-weight-bold">Cancellation Process</p>
                <p>If any of your details were incorrect, you can cancel the order within <strong>12 hours of order</strong>. Contact us with cancel@hirokisliquor.com</p>
                <hr />
            </div>
            <div>
                <h4 class="font-arial"><strong class="font-arial">Order Number:</strong>&nbsp; {{$order->confirmation_number}}</h4>
                <hr />
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-arial font-weight-bold">Delivery For</h5>
                    <p>Name:&nbsp;{{$order->first_name}} {{$order->last_name}}</p>
                    <p>Phone:&nbsp;{{$order->phone}}</p>
                    <p>Email:&nbsp;{{$order->email}}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="font-arial font-weight-bold">Delivery Method</h5>
                    <p>Standard Delivery</p>
                    <p>It will be delivered by {{$order->deliveryDue}}, between 6am and 7pm</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-arial font-weight-bold">Delivery Address</h5>
                    <p>{{$order->delivery_address_1}} {{$order->delivery_address_2}}</p>
                    <p>{{$order->delivery_suburb}} {{$order->delivery_state}} {{$order->delivery_postcode}}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="font-arial font-weight-bold">Billing Address</h5>
                    <p>{{$order->getBillingAddress1()}} {{$order->getBillingAddress2()}}</p>
                    <p>{{$order->getBillingSuburb()}} {{$order->getBillingState()}} {{$order->getBillingPostcode()}}</p>
                </div>
                <hr />
            </div>
        </div>
        <div class="col-md-4">
            @include('www.util.ordersummary', ['items' => $order->getOrderSummary(), 'totalPrice' => $order->formatted_total_price])
        </div>
        <div class="col-md-12">
            <hr />
            <p>You will receive an order confirmation email with the invoice shortly.</p>
            <p>You can safely close this window, or go back to <a href="/">the top page</a></p>
        </div>
    </div>
</div>
@endsection
