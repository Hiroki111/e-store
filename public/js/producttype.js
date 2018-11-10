$(document).ready(function() {
	var state = {};

	function init() {
		//get the card template

		var productTypeId = window.location.pathname.split('/')[2];
		axios.get('/product', {
			params: {
				product_type_id: productTypeId
			}
		}).then(function(result) {
			state.products = result.data;
			//updateCartLabel(result.data);
		}).catch(function(error) {
			//alert("Due to an internal error, it failed to get the cart information. Sorry for the inconvenience.");
		});
	}

	init();
})