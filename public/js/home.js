$(document).ready(function() {
	var state = {};

	function init() {
		axios.get('/cart').then(function(result) {
			updateCartLabel(result.data);
			for (var productId in result.data.products) {
				var qty = result.data.products[productId];
				$("#product-" + productId).val(qty);
			}
		}).catch(function() {
			alert("Due to an internal error, it failed to get the cart information. Sorry for the inconvenience.");
		});
	}

	$('.add-product').click(function() {
		var productId = $(this).attr('data-product-id');
		var qty = $("#product-" + productId).val();

		axios.post('/cart', {
			type: 'product',
			productId: productId,
			qty: Number(qty)
		}).then(function(result) {
			updateCartLabel(result.data);
		}).catch(function(error) {
			alert("Due to an internal error, it failed to update the cart. Sorry for the inconvenience.");
		});
	});

	function updateCartLabel(cart) {
		var qty = Object.values(cart.products).reduce(function(totalQty, qty) {
			return totalQty + qty;
		}, 0);
		$('#cart-counter').text(qty);
	}

	$('[data-toggle="popover"]').popover({
		container: 'body'
	});

	init();
});