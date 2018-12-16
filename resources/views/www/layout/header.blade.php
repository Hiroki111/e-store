<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="min-height: 120px; padding: 0 16px 0 16px;">
    <div class="container d-flex justify-content-between">
      <div class="row" style="width: 100%;">
        <div class="col-3">
          <a class="navbar-brand" style="position: absolute; top: 25%;" href="/"><img src="/images/logo.png"></a>
        </div>
        <div class="col-7">
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div style="width: 100%;">
              <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" style="width: 80%;" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
              </form>
              <ul class="navbar-nav">
                @foreach($productTypes as $productType)
                <li class="nav-item">
                  <a data-nav-product-type="{{$productType->name}}" class="product-type-link nav-link font-weight-bold lead" style="color: white; font-family: Arial, Helvetica, sans-serif;" href="/product-type/{{$productType->id}}">{{$productType->name}}</a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-2">
          <div style="max-width: 100px;" class="pull-right">
            <div style="background-color: white; padding: 5px 10px; border-radius: 5px 5px 0 0; height: 40px;">
              <i class="fa fa-2x fa-shopping-cart"></i>
              <span id="cart-counter" style="margin-left: 15px; font-weight: bold;"></span>
            </div>
            <div style="padding: 10px 10px; border-radius: 0 0 5px 5px; background-color: red; height: 40px; color: white; font-weight: bold;">
              <a href="/checkout" style="color: white; text-decoration: none;">CHECKOUT</a>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </div>
  </nav>
</header>
