@extends('www.layout.master')

@section('title', $productType->name)

@section('content')

<div id="breadcrumbs" class="container">
  <ul>
    <li>
      <a href="/">Home</a>
      <span>›</span>
    </li>
    <li >{{$productType->name}}</li>
  </ul>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <div>

      </div>
    </div>
    <div class="col-sm-9">  </div>
  </div>
</div>

@endsection
