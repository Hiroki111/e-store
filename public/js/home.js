$(document).ready(function() {
	setTimeout(function() {
		if (localStorage.getItem('popState') !== 'shown') {
			$('#popup').modal('show');
			localStorage.setItem('popState', 'shown')
		}
	}, 2000);
});