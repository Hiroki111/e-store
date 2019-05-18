@extends('www.layout.master')

@section('title', 'Payment')

@section('content')

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="/js/payment.js"></script>
<div class="container payment">
	<form action="/payment" method="post" id="payment-form">
		@csrf
		<div class="row" style="padding-top: 40px;">
			<div class="col-md-8">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="list-unstyled" style="padding: 0; margin: 0;">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<div>
					<h4 class="font-arial font-weight-bold">Delivery Details</h4>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="first_name" class="font-weight-bold">First Name</label>
							<input id="first_name" class="form-control" type="text" name="first_name" required>
						</div>
						<div class="form-group col-md-6">
							<label for="last_name" class="font-weight-bold">Last Name</label>
							<input id="last_name" class="form-control" type="text" name="last_name" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="phone" class="font-weight-bold">Phone Number (numerals only)</label>
							<input id="phone" class="form-control" type="tel" name="phone" required>
						</div>
						<div class="form-group col-md-6">
							<label for="email" class="font-weight-bold">Email</label>
							<input id="email" class="form-control" type="email" name="email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label for="delivery_address_1" class="font-weight-bold">Address Line 1</label>
							<input id="delivery_address_1" class="form-control" type="text" name="delivery_address_1" required>
						</div>
						<div class="form-group col">
							<label for="delivery_address_2" class="font-weight-bold">Address Line 2 (Optional)</label>
							<input id="delivery_address_2" class="form-control" type="text" name="delivery_address_2">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label for="delivery_suburb" class="font-weight-bold">Suburb</label>
							<input id="delivery_suburb" class="form-control" type="text" name="delivery_suburb" required>
						</div>
						<div class="form-group col">
							<label for="delivery_state" class="font-weight-bold">State</label>
							<input id="delivery_state" class="form-control" type="text" name="delivery_state" required>
						</div>
						<div class="form-group col">
							<label for="delivery_postcode" class="font-weight-bold">Postcode</label>
							<input id="delivery_postcode" class="form-control" type="text" name="delivery_postcode" required>
						</div>
					</div>
					<hr>
					<h4 class="font-arial font-weight-bold">Billing Address</h4>
					<div class="form-check" style="padding: 0 0 15px 20px;">
						<input id="use_delivery_address" class="form-check-input" type="checkbox" name="use_delivery_address" checked>
						<label class="form-check-label" for="use_delivery_address">Use the same address as the delivery address</label>
					</div>
					<div id="billing-address-inputboxes" style="display: none;">
						<div class="form-row">
							<div class="form-group col">
								<label for="billing_address_1" class="font-weight-bold">Address Line 1</label>
								<input id="billing_address_1" class="form-control" type="text" name="billing_address_1">
							</div>
							<div class="form-group col">
								<label for="billing_address_2" class="font-weight-bold">Address Line 2 (Optional)</label>
								<input id="billing_address_2" class="form-control" type="text" name="billing_address_2">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="billing_suburb" class="font-weight-bold">Suburb</label>
								<input id="billing_suburb" class="form-control" type="text" name="billing_suburb">
							</div>
							<div class="form-group col">
								<label for="billing_state" class="font-weight-bold">State</label>
								<input id="billing_state" class="form-control" type="text" name="billing_state">
							</div>
							<div class="form-group col">
								<label for="billing_postcode" class="font-weight-bold">Postcode</label>
								<input id="billing_postcode" class="form-control" type="text" name="billing_postcode">
							</div>
						</div>
					</div>
					<hr>
					<h4 class="font-arial font-weight-bold">Credit/Debit Card Details</h4>
					<div class="form-row" style="display: inherit !important; ">
    					<div id="card-element">
      					<!-- A Stripe Element will be inserted here. -->
    					</div>
    					<!-- Used to display form errors. -->
    					<div id="card-errors" role="alert"></div>
  					</div>
					<hr>
					<div class="form-check" style="padding: 0 0 15px 20px;">
						<input id="read_policy" class="form-check-input" type="checkbox" name="read_policy">
						<label class="form-check-label" for="read_policy">I have read and agreead with <span><a href="/privacy" id="privacy-policy-link" target="_blank">the Privacy and Security Policy</a></span></label>
					</div>
				</div>
			</div>
			<div class="col-md-4">
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
						@foreach($cart as $item)
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
							<td colspan="3"><span class="font-weight-bold pull-right" style="font-size: 20px;">Total: ${{$cart->getTotalPrice()}}</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row buttons">
			<a id="return-button" class="btn btn-danger font-weight-bold" href="/viewcart">Return to Cart</a>
			<div id="order-spinner" class="spinner-border text-primary" role="status">
				<span class="sr-only">Loading...</span>
			</div>
			<input id="submit-btn" class="btn font-weight-bold pull-right" type="submit" style="" name="order" value="Order"/>
		</div>
	</form>
</div>

@endsection
