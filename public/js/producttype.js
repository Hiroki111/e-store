$(document).ready(function() {

	function init() {
		var url = new URL(location.href);
		var sortBy = url.searchParams.get("sort_by");
		var orderBy = url.searchParams.get("order_by");
		var priceMin = url.searchParams.get("price_min") || "";
		var countryNames = url.searchParams.get("country_names") || "";

		$("option[data-column='" + sortBy + "'][data-order='" + orderBy + "']").prop('selected', true);
		priceMin.split(",").forEach(function(price) {
			$("input[data-price-min='" + price + "']").prop('checked', true);
		});
		countryNames.split(",").forEach(function(countryName) {
			$("input[data-country-name='" + countryName + "']").prop('checked', true);
		});
	}

	$('#sort-items').on('change', function() {
		applyFilter();
	});

	$('#apply-filter-btn').on('click', function() {
		applyFilter();
	});

	function applyFilter() {
		var sortBy = $("#sort-items").find("option:selected").attr('data-column');
		var orderBy = $("#sort-items").find("option:selected").attr('data-order');
		var priceMin = $('.price-range-checkbox:checked').map(function() {
			return $(this).attr('data-price-min');
		}).toArray().join(",");
		var priceMax = $('.price-range-checkbox:checked').map(function() {
			return $(this).attr('data-price-max');
		}).toArray().join(",");
		var countryNames = $('.country-checkbox:checked').map(function() {
			return $(this).attr('data-country-name');
		}).toArray().join(",");

		var parameters = [
			{ key: "sort_by", value: sortBy },
			{ key: "order_by", value: orderBy },
			{ key: "price_min", value: priceMin },
			{ key: "price_max", value: priceMax },
			{ key: "country_names", value: countryNames }
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