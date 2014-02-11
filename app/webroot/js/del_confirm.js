$(document).ready(function() {
    $('.delete').click(function() {
		var agree=confirm("Are you sure you want to delete?");
		if (agree)
			return true;
		else
			return false;
		});
	});
