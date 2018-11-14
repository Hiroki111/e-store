$(document).ready(function() {

	function init() {
		var url = new URL(location.href);
		var sortBy = url.searchParams.get("sort_by");
		var orderBy = url.searchParams.get("order_by");
		var price_min = url.searchParams.get("price_min");

		$("option[data-column='" + sortBy + "'][data-order='" + orderBy + "']").prop('selected', true);
		$("input[data-price-min='" + price_min + "']").prop('checked', true);
	}

	$('#sort-items').on('change', function() {
		applyFilter();
	});

	$('#apply-filter-btn').on('click', function() {
		applyFilter();
	});

	function applyFilter() {
		var sort_by = $("#sort-items").find("option:selected").attr('data-column');
		var order_by = $("#sort-items").find("option:selected").attr('data-order');
		var price_min = $('input[name=price-range-radio]:checked').attr('data-price-min');
		var price_max = $('input[name=price-range-radio]:checked').attr('data-price-max');

		var parameters = [
			{ key: "sort_by", value: sort_by },
			{ key: "order_by", value: order_by },
			{ key: "price_min", value: price_min },
			{ key: "price_max", value: price_max }
		].filter(function(item) {
			return item.value;
		}).reduce(function(total, item, index) {
			if (index < 1) return total += ("?" + item.key + "=" + item.value);

			return total += ("&" + item.key + "=" + item.value);
		}, "");

		location = location.protocol + '//' + location.host + location.pathname + parameters;
	}

	init();
})