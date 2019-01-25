@extends('www.layout.master')

@section('title', 'Payment')

@section('content')

<script type="text/javascript" src="/js/payment.js"></script>
<div class="container">
	<form action="/payment" method="post">
		<div class="row" style="padding-top: 40px;">
			<div class="col-md-8">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="list-unstyled" style="padding: 0; margin: 0;">
						@foreach ($errors->all() as $error)
						<li>Please specify your billing address.</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div>
					<h4 class="font-arial font-weight-bold">Delivery Details</h4>
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
							<label for="delivery-address-1" class="font-weight-bold">Address Line 1</label>
							<input id="delivery-address-1" class="form-control" type="text" name="delivery-address-1" required>
						</div>
						<div class="form-group col">
							<label for="delivery-address-2" class="font-weight-bold">Address Line 2 (Optional)</label>
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
					<h4 class="font-arial font-weight-bold">Billing Address</h4>
					<div class="form-check" style="padding: 0 0 15px 20px;">
						<input id="use-delivery-address" class="form-check-input" type="checkbox" name="use-delivery-address" checked>
						<label class="form-check-label" for="use-delivery-address">Use the same address as the delivery address</label>
					</div>
					<div id="billing-address-inputboxes" style="display: none;">
						<div class="form-row">
							<div class="form-group col">
								<label for="billing-address-1" class="font-weight-bold">Address Line 1</label>
								<input id="billing-address-1" class="form-control" type="text" name="billing-address-1">
							</div>
							<div class="form-group col">
								<label for="billing-address-2" class="font-weight-bold">Address Line 2 (Optional)</label>
								<input id="billing-address-2" class="form-control" type="text" name="billing-address-2">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label for="billing-suburb" class="font-weight-bold">Suburb</label>
								<input id="billing-suburb" class="form-control" type="text" name="billing-suburb">
							</div>
							<div class="form-group col">
								<label for="billing-state" class="font-weight-bold">State</label>
								<input id="billing-state" class="form-control" type="text" name="billing-state">
							</div>
							<div class="form-group col">
								<label for="billing-postcode" class="font-weight-bold">Postcode</label>
								<input id="billing-postcode" class="form-control" type="text" name="billing-postcode">
							</div>
						</div>
					</div>
					<hr>
					<h4 class="font-arial font-weight-bold">Credit Card Details</h4>
					<div class="form-row">
						<div class="form-group col">
							<label for="cc-name" class="font-weight-bold">Name on Credit Card</label>
							<input id="cc-name" class="form-control" type="text" name="cc-name" required>
						</div>
						<div class="form-group col">
							<label for="cc-number" class="font-weight-bold">Credit Card Number</label>
							<input id="cc-number" class="form-control" maxlength="19" type="tel" name="cc-number" required>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<label for="cc-expiration-mm" class="font-weight-bold">Month</label>
							<select id="cc-expiration-mm" class="form-control" type="tel" name="cc-expiration-mm">
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
						</div>
						<div class="col-3">
							<label for="cc-expiration-yy" class="font-weight-bold">Year</label>
							<select id="cc-expiration-yy" class="form-control" type="tel" name="cc-expiration-yy">
								@foreach($years as $year)
								<option value="{{substr($year, 2)}}">{{$year}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-3">
							<label for="cc-cvv" class="font-weight-bold">CVV</label>
							<input id="cc-cvv" maxlength="3" class="form-control" type="text" name="cc-cvv" required>
						</div>
					</div>
					<hr>
					<div class="form-check" style="padding: 0 0 15px 20px;">
						<input id="read-policy" class="form-check-input" type="checkbox" name="read-policy">
						<label class="form-check-label" for="read-policy">I have read and agreead with <span><a href="/privacy" id="privacy-policy-link" target="_blank">the Privacy and Security Policy</a></span></label>
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
		<div class="row">
			<div class="col-md-8">
				<div>
					<a class="btn btn-danger font-weight-bold" style="text-transform: uppercase;" href="/viewcart">Return to Cart</a>
					<input class="btn font-weight-bold pull-right" type="submit" style="background-color: #0068a1; color: white; text-transform: uppercase; width: 145px;" name="order" value="Order"/>
				</div>
			</div>
		</div>
	</form>
</div>

@endsection
