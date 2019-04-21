<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style type="text/css">
    body {
        font-family: Nunito, sans-serif;
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

    </style>
</head>

<body>
    <table cellpadding="10" cellspacing="0">
        <tr id="consignor">
            <td>
                <p class="bold">Hiroki's Liquor</p>
                <p>123 King Street</p>
                <p>Example Hills</p>
                <p>QLD, 4000</p>
            </td>
            <td>
                <img id="logo" src="{{ asset('images/logo.png') }}">
            </td>
        </tr>
        <tr id="customer-details">
            <td width="300" valign="top">
                <p class="bold">Ship to</p>
                <p>{{$order->delivery_address_1}} {{$order->delivery_address_2}} {{$order->delivery_suburb}}, {{$order->delivery_state}}, {{$order->delivery_postcode}}</p>
                <p class="bold">Bill to</p>
                <p>{{$order->first_name}} {{$order->last_name}}</p>
                <p>{{$order->getBillingAddress1()}} {{$order->getBillingAddress2()}} {{$order->getBillingSuburb()}}, {{$order->getBillingState()}}, {{$order->getBillingPostcode()}}</p>
            </td>
            <td width="220" valign="top">
                <p><strong>Order Number :</strong>&nbsp; {{$order->confirmation_number}}</p>
                <p><strong>Ordered Date :</strong>&nbsp; {{$order->orderedDate}}</p>
            </td>
        </tr>
        <tr id="order-summary">
            <td colspan="2">
                <p><strong>Order Summary</strong></p>
                <table cellpadding="5" cellspacing="0">
                    <tr class="order-summary-header">
                        <th width="170">Item</th>
                        <th width="100" class="text-align-right">Unit Price</th>
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
                        <td class="text-align-right"><strong>Total :&nbsp;${{$order->getTotalPrice()}}</strong></td>
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
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="120">SUBTOTAL</td>
                        <td width="80" class="text-align-right">${{$order->getTotalPrice()}}</td>
                    </tr>
                    <tr>
                        <td>Delivery Fee</td>
                        <td class="text-align-right">$ 0</td>
                    </tr>
                    <tr class="note-ground-total">
                        <td><strong>TOTAL</strong></td>
                        <td class="text-align-right"><strong>${{$order->getTotalPrice()}}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
