$(document).ready(function() {
	var state = {};

	function init() {
		axios.get('/cart').then(function(result) {
			updateCartLabel(result.data);
		}).catch(function(error) {
			alert("Due to an internal error, it failed to get the cart information. Sorry for the inconvenience.");
		});
	}

	$('.add-item').click(function() {
		var itemId = $(this).attr('data-item-id');
		var itemSrc = $(this).attr('data-item-src');
		var qty = $("#item-" + itemId).val();
		var type = $(this).attr('data-item-type');

		axios.post('/cart/add', {
			type: type,
			itemId: itemId,
			qty: Number(qty)
		}).then(function(result) {
			console.log('result.data', result.data);
			updateCartLabel(result.data);
			showCartUpdate(itemSrc, qty);
		}).catch(function(error) {
			alert("Due to an internal error, it failed to update the cart. Sorry for the inconvenience.");
		});
	});

	function updateCartLabel(cart) {
		if (!cart.products)
			return $('#cart-counter').text(0);

		var productsQty = Object.values(cart.products).reduce(function(totalQty, qty) {
			return totalQty + qty;
		}, 0);
		var bundlesQty = Object.values(cart.bundles).reduce(function(totalQty, qty) {
			return totalQty + qty;
		}, 0);

		$('#cart-counter').text(productsQty + bundlesQty);
	}

	function showCartUpdate(src, qty) {
		var text = (qty < 2) ? qty + " item" : qty + " items";
		text = text + " added to cart";
		$('#added-item-text').text(text);
		$('#added-item-img').attr('src', src);
		$('#added-item').animate({
			opacity: 1,
		});

		if (state.timer)
			clearTimeout(state.timer);

		state.timer = setTimeout(function() {
			$('#added-item').animate({
				opacity: 0,
			});
		}, 3000);
	}

	init();
});