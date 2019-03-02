<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="An imagenary liquor store">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | Hiroki's Liquor Store</title>

  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/carousel.css">
  <link rel="stylesheet" type="text/css" href="/vendor/lightslider-master/css/lightslider.css" />
  <link rel="stylesheet" type="text/css" href="/css/custom.css">
  <link rel="stylesheet" type="text/css" href="/css/stripe.css">
  <script type="text/javascript" src="/js/app.js"></script>
  <script type="text/javascript" src="/js/cart.js"></script>
  <script type="text/javascript" src="/vendor/lightslider-master/js/lightslider.js"></script>
</head>
<body>
  @include('www.layout.header')
  <main role="main">
    @yield('content')
  </main>
  @include('www.layout.footer')
</body>
</html>
