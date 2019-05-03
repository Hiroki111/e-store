@extends('www.layout.master')
@section('title', 'Pricvacy & Security')
@section('content')
<div class="click-and-collect">
    <div class="click-and-collect__header">
        <p>Shop online with <span>no</span> minimum spend</p>
    </div>
    <div class="click-and-collect__top-icons">
        <div>
            <i class="fa fa-home" aria-hidden="true"></i>
            <h2>FREE collection from your local store</h2>
        </div>
        <div>
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <h2>Pick up within 60 minutes</h2>
        </div>
        <div>
            <i class="fa fa-search" aria-hidden="true"></i>
            <h2>See availability of products in your local store</h2>
        </div>
    </div>
    <div class="click-and-collect__description">
        <div class="click-and-collect__heading">
            <h2 class="blue">How click &amp; collect works</h2>
        </div>
        <div class="click-and-collect__description-container">
            <div class="click-and-collect__description-item">
                <div class="click-and-collect__description-icon-wrapper">
                    <i class="fa fa-laptop" aria-hidden="true"></i>
                </div>
                <div class="click-and-collect__description-textarea">
                    <div class="click-and-collect__description-heading">Shop online with no minimum spend</div>
                    <ul>
                        <li>You can set your local store at any time while browsing, just use the store selector on the top right of the page</li>
                        <li>Retail limits apply to all Click and Collect orders</li>
                    </ul>
                </div>
            </div>
            <div class="click-and-collect__description-item">
                <div class="click-and-collect__description-icon-wrapper">
                    <i class="fa fa-beer" aria-hidden="true"></i>
                </div>
                <div class="click-and-collect__description-textarea">
                    <div class="click-and-collect__description-heading">
                        Select FREE Click &amp; Collect at checkout</div>
                    <ul>
                        <li>At checkout, you’ll be asked your preferred delivery method, If you’ve already set your local store these details will come up automatically when you select Click and Collect</li>
                    </ul>
                </div>
            </div>
            <div class="click-and-collect__description-item">
                <div class="click-and-collect__description-icon-wrapper">
                    <i class="fa fa-mobile" aria-hidden="true"></i>
                </div>
                <div class="click-and-collect__description-textarea">
                    <div class="click-and-collect__description-heading">
                        We’ll text you when your order is ready</div>
                    <ul>
                        <li>You’ll receive a text message as soon as your order has been packed by our store teams, which will be within 60 minutes</li>
                        <li>Pick up is only available during store trading hours, if you place your order at night your order will be available for collection the following day</li>
                    </ul>
                </div>
            </div>
            <div class="click-and-collect__description-item">
                <div class="click-and-collect__description-icon-wrapper">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </div>
                <div class="click-and-collect__description-textarea">
                    <div class="click-and-collect__description-heading">
                        Collect from your chosen store</div>
                    <ul>
                        <li>Please ensure all orders are collected by the person placing the order</li>
                        <li>All credit card order details must match ID provided at pick up</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="click-and-collect__heading">
            <h2 class="red">How easy is that?</h2>
        </div>
    </div>
</div>
@endsection
