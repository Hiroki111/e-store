@extends('www.layout.master')

@section('title', 'Checkout Option')

@section('content')

<div class="container">
	<div class="row" style="padding-top: 40px;">
		<div class="col-md-6">
			<h3>Sign In</h3>
			<p>Have you shopped here before and saved your contact details?</p>
			<p>You can sign in for faster checkout!</p>
			<form>
				<div class="form-group">
					<label for="signin-email-input" class="font-weight-bold">Email</label>
					<input id="signin-email-input" class="form-control col-md-8" type="email" name="email">
				</div>
				<div class="form-group">
					<label for="signin-password-input" class="font-weight-bold">Password</label>
					<input id="signin-password-input" class="form-control col-md-8" type="password" name="password">
				</div>
				<input class="btn font-weight-bold" type="submit" style="background-color: #0068a1; color: white; text-transform: uppercase;" name="signin" value="Sign in">
			</form>
		</div>
		<div class="col-md-6">
			<h3>Checkout as a guest</h3>
			<p>You don't need an account to checkout. You'll have a chance to create an account during the process.</p>
			<button class="btn font-weight-bold" style="background-color: #0068a1;">
				<a href="/payment" style="color: white; text-transform: uppercase;">Checkout as a guest</a>
			</button>
		</div>
	</div>
</div>

@endsection
