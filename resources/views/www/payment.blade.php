@extends('www.layout.master')

@section('title', 'Payment')

@section('content')

<script type="text/javascript" src="/js/payment.js"></script>
<div class="container">
	<div class="row" style="padding-top: 40px;">
		<div class="col-md-6">
			<h3 class="font-weight-bold font-arial">Order Summary</h3>
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
		<div class="col-md-6" style="overflow-y: scroll; height: 70vh;">
			<div >
				<h4 class="font-arial">Delivery Details</h4>
				<form>
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
						<div class="form-group col">
							<label for="delivery-address-1" class="font-weight-bold">Address Line 1</label>
							<input id="delivery-address-1" class="form-control" type="text" name="delivery-address-1" required>
						</div>
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
								<input id="billing-address-1" class="form-control" type="text" name="billing-address-1">
							</div>
							<div class="form-group col">
								<label for="billing-address-2" class="font-weight-bold">Address Line 2</label>
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
					<h4 class="font-arial">Credit Card Details</h4>
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
							<label for="expiration-mm" class="font-weight-bold">Month</label>
							<select id="expiration-mm" class="form-control" type="tel" name="expiration-mm">
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
							<label for="expiration-yy" class="font-weight-bold">Year</label>
							<select id="expiration-yy" class="form-control" type="tel" name="expiration-yy">
								@foreach($years as $year)
								<option value="{{$year}}">{{$year}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-3">
							<label for="csv" class="font-weight-bold">CSV</label>
							<input id="csv" maxlength="3" class="form-control" type="text" name="csv" required>
						</div>
					</div>
					<hr>
					<div class="form-check" style="padding: 0 0 15px 20px;">
						<input id="read-policy" class="form-check-input" type="checkbox" name="read-policy">
						<label class="form-check-label" for="read-policy">I have read and agreead with <span><a href="/privacy" id="privacy-policy-link" target="_blank">the Privacy and Security Policy</a></span></label>
					</div>
					<div>
						<a class="btn btn-danger font-weight-bold" style="text-transform: uppercase;" href="/viewcart">Return to Cart</a>
						<input class="btn font-weight-bold pull-right" type="submit" style="background-color: #0068a1; color: white; text-transform: uppercase;" name="order" value="Order"/>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

@endsection
