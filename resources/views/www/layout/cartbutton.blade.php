<div class="cart-button">
    <div class="white-space">
        <a class="checkout-link" href="/viewcart">
            <i class="fa fa-2x fa-shopping-cart"></i>
            <span class="cart-counter"></span>
        </a>
    </div>
</div>
<script type="text/javascript">
$(document).scroll(function() {
    var y = $(this).scrollTop();
    if (y > 250) {
        $('.cart-button').fadeIn();
    } else {
        $('.cart-button').fadeOut();
    }
});
</script>
