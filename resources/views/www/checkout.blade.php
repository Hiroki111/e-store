@extends('www.layout.master')

@section('title', 'Checkout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-10 offset-md-1">
			<h3 class="font-weight-bold font-arial" style="margin: 20px 0 0 0;">View Cart ({{$cart->count}}@if($cart->count > 1) items @else item @endif)</h3>
			<table id="checkout-table" class="table">
				<thead>
					<tr style="border-bottom: 2px solid black;">
						<th class="font-arial">Your Items</th>
						<th class="font-arial"></th>
						<th class="font-arial">Quantity</th>
						<th class="font-arial" style="padding-right: 0;
						float: right;">Price</th>
					</tr>
				</thead>
				<tbody style="border-bottom: 1px solid #dee2e6;">
					@foreach($cart as $i => $item)
					<tr>
						<td style="width: 10%">
							<a href="{{$item->url}}"><img src="{{$item->src}}" style="max-height: 100px; display: block; margin: 0 auto;"></a>
						</td>
						<td>
							<div>
								<h5 class="font-weight-bold font-arial"><a href="{{$item->url}}" style="color: red;">{{$item->name}}</a></h5>
								<p style="margin: 0;">Each ${{$item->price}}</p>
							</div>
						</td>
						<td>
							<div>
								<div>
									<input type="number" id="" min="1" max="50" value="{{$item->qty}}" style="text-align: center; width: 70px;">
								</div>
							</div>
						</td>
						<td style="width: 10%; padding-right: 0;">
							<div><p class="font-weight-bold pull-right">${{$item->total_price}}</p></div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<hr>
		<div class="col-3 offset-8">
			<h3 class="font-weight-bold font-arial pull-right">Total ${{$cart->getTotalPrice()}}</h3>
		</div>
		<div class="col-3 offset-8" style="padding-bottom: 10px;">
			<span class="pull-right"><a href="/">Continue Shopping</a> OR <button class="btn font-weight-bold" style="color: white; background-color: red;">Checkout</button></span>
		</div>
	</div>
</div>

@endsection
