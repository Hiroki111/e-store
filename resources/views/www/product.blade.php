@extends('www.layout.master')

@section('title', $product->name)

@section('content')

<script type="text/javascript" src="/js/producttype.js"></script>
<div id="breadcrumbs" class="container">
	<ul>
		<li>
			<a href="/">Home</a>
			<span>›</span>
		</li>
		<li>
			<a href="/product-type/{{$productType->id}}">{{$productType->name}}</a>
			<span>›</span>
		</li>
    <li>{{$product->name}}</li>
  </ul>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-5">
    <div style="max-width: 100%;">
        <img class="" style="width: 100%;" src="{{$product->src}}">
      </div>
    </div>
    <div class="col-sm-7">

    </div>
  </div>
  @include('www.layout.addeditem')
</div>

@endsection
