<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="An imagenary liquor store">

  <title>Hiroki's Liquor Store</title>

  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/carousel.css">
  <link rel="stylesheet" type="text/css" href="/css/custom.css">
  <script type="text/javascript" src="/js/app.js"></script>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="min-height: 120px;">
      <a class="navbar-brand" href="#"><img src="/images/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div style="position: absolute;left: 25%;width: 50%;">
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" style="width: 80%;" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
        <div style="position: absolute;right: 3%;">
          <div style="background-color: white; padding: 5px 10px; border-radius: 5px 5px 0 0; height: 40px;">
            <i class="fa fa-2x fa-shopping-cart"></i>
          </div>
          <div style="padding: 10px 10px; border-radius: 0 0 5px 5px; background-color: red; height: 40px; color: white; font-weight: bold;">
            CHECKOUT
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main role="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        @foreach($slides as $i => $slide)
        <div class="carousel-item @if($i === 0) active @endif">
          <img src="{{$slide->src}}" alt="{{$slide->title}}">
          <div class="container">
            <div class="carousel-caption text-left">
              <h1 class="outlined-text">{{$slide->title}}</h1>
              <p class="outlined-text">{{$slide->description}}</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">MORE</a></p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="container marketing">
      <div class="row">
        <div class="col-lg-6">
          <h2><i class="fa fa-truck" aria-hidden="true"></i> Delivery Info</h2>
          <div style="min-height: 60px">
            <p style="margin: 0;">FREE domestic delivery on all wine</p>
            <p style="margin: 0;">FREE international delivery on any order over $150</p>
          </div>
          <p><a class="btn btn-secondary" href="#" role="button">View Details &raquo;</a></p>
        </div>
        <div class="col-lg-6">
          <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order &amp; Payment</h2>
          <div style="min-height: 60px">
            <p style="margin: 0;">Online, Phone, In Store</p>
          </div>
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
  </main>

</body>
</html>
