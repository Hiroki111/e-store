<header>
    <nav>
        <div class="header-top">
            <div class="logo">
                <a href="/"><img src="/images/logo.png"></a>
            </div>
            <div class="search-box">
                <form class="form-inline mt-2 mt-md-0" id="search-item" action="/search-item" method="get">
                    <input type="hidden" id="search-item-parameter" name="query" value="" />
                    <input class="form-control mr-sm-2" id="search-item-keyword" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="basket">
                <div
                 class="white-space">
                    <i class="fa fa-2x fa-shopping-cart"></i>
                    <span id="cart-counter"></span>
                </div>
                <div class="red-space">
                    <a class="checkout-link" href="/viewcart">CHECKOUT</a>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <ul class="navbar-nav">
                @foreach($productTypes as $productType)
                <li class="nav-item">
                    <a data-nav-product-type="{{$productType->name}}" class="product-type-link nav-link font-weight-bold lead" href="/product-type/{{$productType->id}}">{{$productType->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>
</header>
