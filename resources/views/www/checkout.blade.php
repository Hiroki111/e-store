@extends('www.layout.master')

@section('title', 'Checkout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<h2 class="font-weight-bold">View Cart ({{$cart->count}}@if($cart->count > 1) items @else item @endif)</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Your Items</th>
						<th>Quantity</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart as $item)
					<tr>
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
