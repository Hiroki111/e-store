@extends('www.layout.master')
@section('title', 'Delivery')
@section('content')
<div class="delivery">
    <div class="delivery__header">
        <div class="delivery_icons">
            <i class="fa fa-glass" aria-hidden="true"></i>
            <i class="fa fa-beer" aria-hidden="true"></i>
            <i class="fa fa-gift" aria-hidden="true"></i>
            <i class="fa fa-glass" aria-hidden="true"></i>
            <i class="fa fa-beer" aria-hidden="true"></i>
            <i class="fa fa-gift" aria-hidden="true"></i>
            <i class="fa fa-glass" aria-hidden="true"></i>
            <i class="fa fa-beer" aria-hidden="true"></i>
            <i class="fa fa-truck" aria-hidden="true"></i>
        </div>
        <h2>delivery to suit you</h2>
    </div>
    <div class="delivery__table-wrapper">
        <table class="delivery__table" cellpadding="10">
            <tr class="delivery__table-header">
                <th width="25%">your delivery option</th>
                <th width="25%">when you oreder</th>
                <th width="30%">delivered</th>
                <th width="20%">price</th>
            </tr>
            <tr>
                <td class="delivery-options"><i class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></i> standard</td>
                <td>Anytime</td>
                <td>In 2 - 5 business days, Monday to Friday between 9am - 5pm.</td>
                <td><strong>$6.95</strong><br/><strong>FREE</strong> on wine orders over $150</td>
            </tr>
            <tr>
                <td class="delivery-options"><i class="fa fa-clock-o" aria-hidden="true"></i> same day</td>
                <td>Before midday from Monday to Friday.
                    *Excludes Public Holidays</td>
                <td>By 5pm.</td>
                <td>$<strong>14.95</strong></td>
            </tr>
            <tr>
                <td class="delivery-options"><i class="fa fa-calendar" aria-hidden="true"></i> next business day</td>
                <td>Before midnight from Monday to Friday.</td>
                <td>Next business day before 5pm.</td>
                <td><strong>$9.95</strong></td>
            </tr>
        </table>
    </div>
</div>
@endsection
