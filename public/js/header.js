$(document).ready(function() {
	var itemNames = [];

	function init() {
		axios.get('/item-names').then(function(result) {
			itemNames = result.data;
			var substringMatcher = function(strs) {
				return function findMatches(q, cb) {
					var matches, substringRegex;

					matches = [];

					substrRegex = new RegExp(q, 'i');

					$.each(strs, function(i, str) {
						if (substrRegex.test(str)) {
							matches.push(str);
						}
					});

					cb(matches);
				};
			};

			$('#search-item-keyword').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'itemNames',
				source: substringMatcher(itemNames),
			});

		}).catch(function(error) {
			alert("Due to an internal error, it failed to get the cart information. Sorry for the inconvenience.");
		});
	}

	$('#search-item-keyword').on('typeahead:selected', function(e, datum) {
		location = "/search-item?query=" + datum;
	});

	$('#search-item').submit(function(event) {
		if (!$('#search-item-keyword').val()) {
			alert("Please enter a search keyword.");
			event.preventDefault();
			return;
		}

		$('#search-item-parameter').val($('#search-item-keyword').val());
	});

	init();
});