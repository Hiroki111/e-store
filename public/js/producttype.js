$(document).ready(function() {

	function init() {
		var urlString = location.href;
		var url = new URL(urlString);
		var sortBy = url.searchParams.get("sort_by");
		var orderBy = url.searchParams.get("order_by");

		$("option[data-column='" + sortBy + "'][data-order='" + orderBy + "']").prop('selected', true);
	}

	$('#sort-items').on('change', function(e) {
		var selecedOption = $(this).find("option:selected");
		var column = selecedOption.attr('data-column');
		var order = selecedOption.attr('data-order');
		var url = location.protocol + '//' + location.host + location.pathname;

		location = url + "?sort_by=" + column + "&order_by=" + order;
	});

	init();
})