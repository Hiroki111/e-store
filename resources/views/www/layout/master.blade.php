<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="An imaginary liquor store">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | Hiroki's Liquor Store</title>

  <meta property="og:description" content="Australia's number 1 online drinks shop. Hard to get & collectable spirits, beer, wine barware and more. (NOTE: This is an imaginary shop, so you won't be able to buy anything)">
  <meta property="og:url" content="https://store.hiroki-t.com/">
  <meta property="og:image" content="https://store.hiroki-t.com/images/slides/1.jpeg">
  <meta property="og:title" content="Hiroki's Liquor Store">
  <meta property="og:site_name" content="Hiroki's Liquor Store">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@takahas779">
  <meta name="twitter:title" content="Hiroki's Liquor Store">
  <meta name="twitter:description" content="Australia's number 1 online drinks shop. Hard to get & collectable spirits, beer, wine barware and more. (NOTE: This is an imaginary shop, so you won't be able to buy anything)">
  <meta name="twitter:image" content="https://store.hiroki-t.com/images/slides/1.jpeg">

  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/carousel.css">
  <link rel="stylesheet" type="text/css" href="/vendor/lightslider-master/css/lightslider.css" />
  <link rel="stylesheet" type="text/css" href="/css/custom.css">
  <link rel="stylesheet" type="text/css" href="/css/stripe.css">
  <script type="text/javascript" src="/js/app.js"></script>
  <script type="text/javascript" src="/js/home.js"></script>
  <script type="text/javascript" src="/js/header.js"></script>
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
