@extends('www.layout.master')

@section('title', 'Payment')

@section('content')

<script type="text/javascript" src="/js/payment.js"></script>
<div class="container">
	<div class="row" style="padding-top: 40px;">
		<div class="col-md-6">
			<h3 class="font-weight-bold font-arial">Order Summary</h3>
			<table class="table" style="width: 100%">
				<thead class="thead-dark">
					<tr>
						<th>Item</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart as $item)
					<tr >
						<td style="width: 60%">{{$item->name}}</td>
						<td style="width: 10%">× {{$item->qty}}</td>
						<td style="width: 30%"><span class="pull-right font-weight-bold"> ${{$item->total_price}}</span></td>
					</tr>
					@endforeach
					<tr>
						<td colspan="3"><span class="font-weight-bold pull-right" style="font-size: 20px;">Total: ${{$cart->getTotalPrice()}}</span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h3 class="font-weight-bold font-arial">Delivery Details</h3>
			<form>
				<h4 class="font-arial">Delivery Name</h4>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="first-name" class="font-weight-bold">First Name</label>
						<input id="first-name" class="form-control" type="text" name="first-name" required>
					</div>
					<div class="form-group col-md-6">
						<label for="last-name" class="font-weight-bold">Last Name</label>
						<input id="last-name" class="form-control" type="text" name="last-name" required>
					</div>
				</div>
				<hr>
				<h4 class="font-arial">Delivery Address</h4>
				<div class="form-row">
					<div class="form-group col">
						<label for="delivery-address-1" class="font-weight-bold">Address Line 1</label>
						<input id="delivery-address-1" class="form-control" type="text" name="delivery-address-1" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
						<label for="delivery-address-2" class="font-weight-bold">Address Line 2</label>
						<input id="delivery-address-2" class="form-control" type="text" name="delivery-address-2">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
						<label for="delivery-suburb" class="font-weight-bold">Suburb</label>
						<input id="delivery-suburb" class="form-control" type="text" name="delivery-suburb" required>
					</div>
					<div class="form-group col">
						<label for="delivery-state" class="font-weight-bold">State</label>
						<input id="delivery-state" class="form-control" type="text" name="delivery-state" required>
					</div>
					<div class="form-group col">
						<label for="delivery-postcode" class="font-weight-bold">Postcode</label>
						<input id="delivery-postcode" class="form-control" type="text" name="delivery-postcode" required>
					</div>
				</div>
				<hr>
				<h4 class="font-arial">Billing Address</h4>
				<div class="form-check" style="padding: 0 0 15px 20px;">
					<input id="use-delivery-address" class="form-check-input" type="checkbox" name="use-delivery-address" checked>
					<label class="form-check-label" for="use-delivery-address">Use the same address as the delivery address</label>
				</div>
				<div id="billing-address-inputboxes" style="display: none;">
					<div class="form-row">
						<div class="form-group col">
							<label for="billing-address-1" class="font-weight-bold">Address Line 1</label>
							<input id="billing-address-1" class="form-control" type="text" name="billing-address-1" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label for="billing-address-2" class="font-weight-bold">Address Line 2</label>
							<input id="billing-address-2" class="form-control" type="text" name="billing-address-2">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label for="billing-suburb" class="font-weight-bold">Suburb</label>
							<input id="billing-suburb" class="form-control" type="text" name="billing-suburb" required>
						</div>
						<div class="form-group col">
							<label for="billing-state" class="font-weight-bold">State</label>
							<input id="billing-state" class="form-control" type="text" name="billing-state" required>
						</div>
						<div class="form-group col">
							<label for="billing-postcode" class="font-weight-bold">Postcode</label>
							<input id="billing-postcode" class="form-control" type="text" name="billing-postcode" required>
						</div>
					</div>
				</div>
				<input class="btn font-weight-bold" type="submit" style="background-color: #0068a1; color: white; text-transform: uppercase;" name="order" value="Order">
			</form>
		</div>

	</div>
</div>

@endsection
