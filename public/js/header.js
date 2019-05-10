$(document).ready(function() {
	$('#search-item').submit(function(event) {
		if (!$('#search-item-keyword').val()) {
			alert("Please enter a search keyword.");
			return event.preventDefault();
		}

		$('#search-item-parameter').val($('#search-item-keyword').val());
	});
});