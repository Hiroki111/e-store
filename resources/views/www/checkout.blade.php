@extends('www.layout.master')

@section('title', 'Checkout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<h3 class="font-weight-bold font-arial" style="margin: 30px 0;">View Cart ({{$cart->count}}@if($cart->count > 1) items @else item @endif)</h3>
			<table class="table">
				<thead>
					<tr>
						<th style="border: none; font-size: 20px;">Your Items</th>
						<th style="border: none; font-size: 20px;">Quantity</th>
						<th style="border: none; font-size: 20px;">Price</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart as $i => $item)
					<tr @if($i===0) style="border-top: 2px solid black;" @endif>
						<td>
							<img src="{{$item->src}}" style="max-height: 50px;">
							<h5>{{$item->name}}</h5>
							<p>${{$item->price}}</p>
						</td>
						<td>
							<p>{{$item->qty}}</p>
						</td>
						<td>
							<p>${{$item->total_price}}</p>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<hr>
		<div class="col-4 offset-8">
			Total ${{$cart->getTotalPrice()}}
		</div>
		<div class="col-4 offset-8">
			<a href="/">Continue Shopping</a> OR <button>Checkout</button>
		</div>
	</div>
</div>

@endsection
