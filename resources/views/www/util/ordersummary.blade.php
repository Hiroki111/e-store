<h4 class="font-weight-bold font-arial">Order Summary</h4>
<table class="table" style="width: 100%">
    <thead style="background-color: #252d6c;color: white;">
        <tr>
            <th>Item</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td style="width: 60%">{{$item->name}}</td>
            <td style="width: 10%; padding: 0.75rem 0;">× {{$item->qty}}</td>
            <td style="width: 30%"><span class="pull-right font-weight-bold">${{$item->total_price}}</span></td>
        </tr>
        @endforeach
        <tr>
            <td style="width: 60%">Delivery Fee</td>
            <td style="width: 10%; padding: 0.75rem 0;"></td>
            <td style="width: 30%"><span class="pull-right font-weight-bold">$0</span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="font-weight-bold pull-right" style="font-size: 20px;">Total: ${{$totalPrice}}</span></td>
        </tr>
    </tbody>
</table>
