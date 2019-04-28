<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style type="text/css">
    body {
        font-family: Nunito, sans-serif;
    }

    td {
        padding: 0 20px;
    }

    #logo {
        padding: 10px;
        background: #252d6c;
        position: fixed;
        right: 0;
        top: 10;
    }

    #consignor td p,
    #customer-details td p,
    #note td p {
        margin: 7px 0;
    }

    .order-summary-header,
    .note-ground-total {
        background: LightGrey;
    }

    .bold {
        font-weight: bold;
    }

    .text-align-right {
        text-align: right;
    }

    .text-align-left {
        text-align: left;
    }

    .text-align-center {
        text-align: center;
    }
    </style>
</head>

<body>
    <div style="height: 70px; border-top: 11px #d2232a solid; background: #252d6c; width: 100%;">
        <a class="navbar-brand" style="position: absolute; top: 25%;" href="/"><img src="{{ asset('images/logo.png') }}"></a>
    </div>
    <table width="100%" style="background-color: lightgray;
    border-spacing: 0;
    padding: 0 80px;">
        <tbody style="background-color: white;">
            <tr>
                <td colspan="2">
                    <h1 class="text-align-center">Thank you for your order!</h1>
                    <h2 class="text-align-center">Your order is on its way</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p><strong>Order Number:&nbsp; {{$order->confirmation_number}}</strong></p>
                    <p><strong>Ordered Date :</strong>&nbsp; {{$order->orderedDate}}</p>
                    <p></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Dear <strong>{{$order->first_name}} {{$order->last_name}}</strong>,</p>
                    <p>We're pleased to let you know that your order is winging its way to you. </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Shipping address:</strong></p>
                    <p>{{$order->first_name}} {{$order->last_name}}</p>
                    <p>{{$order->delivery_address_1}} {{$order->delivery_address_2}}</p>
                    <p>{{$order->delivery_suburb}}</p>
                    <p>{{$order->delivery_state}}</p>
                    <p>{{$order->delivery_postcode}}</p>
                </td>
                <td>
                    <p><strong>Billing address:</strong></p>
                    <p>{{$order->getBillingAddress1()}} {{$order->getBillingAddress2()}}</p>
                    <p>{{$order->getBillingSuburb()}}</p>
                    <p>{{$order->getBillingState()}}</p>
                    <p>{{$order->getBillingPostcode()}}</p>
                </td>
            </tr>
            <tr id="order-summary">
                <td colspan="2">
                    <p><strong>Order Summary</strong></p>
                    <table cellpadding="5" cellspacing="0" width="100%">
                        <tr class="order-summary-header">
                            <th width="170">Item</th>
                            <th width="100" class="text-align-right">Item Price</th>
                            <th width="100" class="text-align-right">Quantity</th>
                            <th width="130" class="text-align-right">Line Total</th>
                        </tr>
                        @foreach($order->getOrderSummary() as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td class="text-align-right">$ {{$item->price}}</td>
                            <td class="text-align-right">× {{$item->qty}}</td>
                            <td class="text-align-right"><strong>${{$item->total_price}}</strong></td>
                        </tr>
                        @endforeach
                        <tr class="order-summary-total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-align-right"><strong>Total :&nbsp;${{$order->formatted_total_price}}</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="note">
                <td width="260">
                    <p class="bold">NOTES/MEMO</p>
                    <p>Standard Delivery</p>
                    <p>It will be delivered by {{$order->deliveryDue}}</p>
                </td>
                <td width="260">
                    <table cellpadding="5" cellspacing="0" width="100%">
                        <tr>
                            <td width="120">SUBTOTAL</td>
                            <td width="80" class="text-align-right">${{$order->formatted_total_price}}</td>
                        </tr>
                        <tr>
                            <td>Delivery Fee</td>
                            <td class="text-align-right">$ 0.00</td>
                        </tr>
                        <tr class="note-ground-total">
                            <td><strong>TOTAL</strong></td>
                            <td class="text-align-right"><strong>${{$order->formatted_total_price}}</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="text-align-center">Thank you for shopping with us!</p>
                    <p class="text-align-center">Hiroki's Liquor Customer Service Team</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
