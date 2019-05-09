<div class="card-wrapper">
    <div class="card mb-3 shadow-sm">
        <a href="/{{$type}}/{{$item->hashed_id}}">
            <div class="card-img-frame">
                <img class="card-img-top" src="{{$item->src}}">
            </div>
        </a>
        <div class="card-body text-center">
            <h5 class="card-text">{{$item->name}}</h5>
            <div class="flex-wrapper flex-wrapper-first">
                <div class="product-tile-price-big" style="color: #D2232A; display: flex;">
                    <div class="price-bundle-new">
                        <span class="price" style="font-size: 22px; font-weight: 900; vertical-align: top;">
                            <span class="currency" style="font-size: 12px;">$</span>
                            {{$item->dollars}}
                            <span class="cents" style="font-size: 12px;">.{{$item->cents}}</span>
                        </span>
                    </div>
                    <div class="price-des" style="font-size: 12px; margin-left: 5px; margin-top: 7px;">Each</div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="-1" data-item-type="{{$type}}" data-item-id="{{$item->hashed_id}}">-</button>
                    </div>
                    <input type="number" id="{{$type}}-{{$item->hashed_id}}" min="1" max="50" value="1" style="text-align: center;" class="form-control">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-outline-secondary update-qty-btn" data-update-qty="1" data-item-type="{{$type}}" data-item-id="{{$item->hashed_id}}">+</button>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <button data-item-type="{{$type}}" data-item-id="{{$item->hashed_id}}" data-item-src="{{$item->src}}" type="button" class="btn add-item add-to-cart-button">Add to Cart</button>
            </div>
        </div>
    </div>
</div>
