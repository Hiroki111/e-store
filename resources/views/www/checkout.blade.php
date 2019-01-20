@extends('www.layout.master')

@section('title', 'Checkout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-10 offset-md-1">
			<h3 class="font-weight-bold font-arial" style="margin: 30px 0 10px;">View Cart ({{$cart->count}}@if($cart->count > 1) items @else item @endif)</h3>
			<table class="table">
				<thead>
					<tr style="border-bottom: 2px solid black;">
						<th style="border: none; font-size: 20px;">Your Items</th>
						<th style="border: none; font-size: 20px;"></th>
						<th style="border: none; font-size: 20px;">Quantity</th>
						<th style="border: none; font-size: 20px; padding-right: 0;
						float: right;">Price</th>
					</tr>
				</thead>
				<tbody style="border-bottom: 1px solid #dee2e6;">
					@foreach($cart as $i => $item)
					<tr>
						<td style="width: 10%">
							<img src="{{$item->src}}" style="max-height: 100px;">
						</td>
						<td>
							<h5 class="font-weight-bold" style="color: red;">{{$item->name}}</h5>
							<p>Each ${{$item->price}}</p>
						</td>
						<td>
							<p class="font-weight-bold">{{$item->qty}}</p>
						</td>
						<td style="width: 10%; padding-right: 0;">
							<p class="font-weight-bold pull-right">${{$item->total_price}}</p>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<hr>
		<div class="col-3 offset-8">
			<h3 class="font-weight-bold pull-right">Total ${{$cart->getTotalPrice()}}</h3>
		</div>
		<div class="col-3 offset-8" style="padding-bottom: 10px;">
			<span class="pull-right"><a href="/">Continue Shopping</a> OR <button class="btn font-weight-bold" style="color: white; background-color: red;">Checkout</button></span>
		</div>
	</div>
</div>

@endsection
