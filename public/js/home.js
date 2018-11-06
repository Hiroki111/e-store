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
		var type = $(this).attr('data-item-type');
		var qty = $("#" + type + "-" + itemId).val();

		axios.post('/cart/add', {
			type: type,
			itemId: itemId,
			qty: Number(qty)
		}).then(function(result) {
			updateCartLabel(result.data);
			showCartUpdate(itemSrc, qty);
		}).catch(function(error) {
			alert("Due to an internal error, it failed to update the cart. Sorry for the inconvenience.");
		});
	});

	$('.update-qty-btn').click(function() {
		var itemId = $(this).attr('data-item-id');
		var qty = $(this).attr('data-update-qty');
		var type = $(this).attr('data-item-type');
		var currentVal = $("#" + type + "-" + itemId).val();

		if (Number(currentVal) + Number(qty) < 1) return;

		$("#" + type + "-" + itemId).val(Number(currentVal) + Number(qty));
	});

	function updateCartLabel(cart) {
		var groundTotal = _(cart).flatMap()
			.map(function(item) {
				return _.valuesIn(item);
			}).map(function(item) {
				return item.reduce(function(totalValue, value) {
					return totalValue + value;
				}, 0);
			}).reduce(function(totalValue, value) {
				return totalValue + value;
			}, 0);

		$('#cart-counter').text(groundTotal);
	}

	function showCartUpdate(src, qty) {
		var text = (qty < 2) ? qty + " item" : qty + " items";
		text = text + " added to cart";
		$('#added-item-text').text(text);
		$('#added-item-img').attr('src', src);
		$('#added-item').fadeIn();

		if (state.timer)
			clearTimeout(state.timer);

		state.timer = setTimeout(function() {
			$('#added-item').fadeOut();
		}, 3000);
	}

	init();
});