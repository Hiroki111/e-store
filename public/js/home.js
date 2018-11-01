$(document).ready(function() {
	var state = {};

	function init() {
		axios.get('/cart').then(function(result) {
			updateCartLabel(result.data);
		}).catch(function(error) {
			alert("Due to an internal error, it failed to get the cart information. Sorry for the inconvenience.");
		});
	}

	$('.add-product').click(function() {
		var productId = $(this).attr('data-product-id');
		var productSrc = $(this).attr('data-product-src');
		var qty = $("#product-" + productId).val();

		axios.post('/cart/add', {
			type: 'products',
			productId: productId,
			qty: Number(qty)
		}).then(function(result) {
			updateCartLabel(result.data);
			showCartUpdate(productSrc, qty);
		}).catch(function(error) {
			alert("Due to an internal error, it failed to update the cart. Sorry for the inconvenience.");
		});
	});

	function updateCartLabel(cart) {
		if (!cart.products) return;

		var qty = Object.values(cart.products).reduce(function(totalQty, qty) {
			return totalQty + qty;
		}, 0);
		$('#cart-counter').text(qty);
	}

	function showCartUpdate(src, qty) {
		var text = (qty < 2) ? qty + " item" : qty + " items";
		text = text + " added to cart";
		$('#added-item-text').text(text);
		$('#added-item-img').attr('src', src);
		$('#added-item').animate({
			opacity: 1,
		});
	}

	init();
});