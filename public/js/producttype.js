$(document).ready(function() {

	function init() {
		var url = new URL(location.href);
		var sortBy = url.searchParams.get("sort_by");
		var orderBy = url.searchParams.get("order_by");
		var priceMin = url.searchParams.get("price_min") || "";
		var countryNames = url.searchParams.get("country_names") || "";
		var brandNames = url.searchParams.get("brand_names") || "";

		$("option[data-column='" + sortBy + "'][data-order='" + orderBy + "']").prop('selected', true);
		priceMin.split(",").forEach(function(price) {
			$('input[data-price-min="' + price + '"]').prop('checked', true);
		});
		countryNames.split(",").forEach(function(countryName) {
			$('input[data-country-name="' + countryName + '"]').prop('checked', true);
		});
		brandNames.split(",").forEach(function(brandName) {
			$('input[data-brand-name="' + brandName + '"]').prop('checked', true);
		});
	}

	$('.filter-keyword').on('click', function() {
		var targetUl = '#' + $(this).attr('data-filter-keyword') + '-ul';

		if ($(targetUl).css('display') === 'none') {
			$(targetUl).slideDown();
			$(this).find("i").removeClass('fa-plus').addClass('fa-minus');
		} else {
			$(targetUl).slideUp();
			$(this).find("i").removeClass('fa-minus').addClass('fa-plus');
		}
	});

	$('.remove-selected-filter').on('click', function() {
		var category = $(this).attr('data-remove-category').replace(" ", "-").toLowerCase();
		$("." + category + "-checkbox").prop('checked', false);

		applyFilter();
	});

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
		var brandNames = $('.brand-checkbox:checked').map(function() {
			return $(this).attr('data-brand-name');
		}).toArray().join(",");

		var parameters = [
			{ key: "sort_by", value: sortBy },
			{ key: "order_by", value: orderBy },
			{ key: "price_min", value: priceMin },
			{ key: "price_max", value: priceMax },
			{ key: "country_names", value: countryNames },
			{ key: "brand_names", value: brandNames }
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