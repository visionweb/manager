$(document).ready(function() {
	$('#n1').click(function(){
		var currentdate = new Date(); 
		$('#start').val(currentdate.getHours() + ":" + currentdate.getMinutes());
	});
	$('#n2').click(function(){
		var currentdate = new Date(); 
		$('#end').val(currentdate.getHours() + ":" + currentdate.getMinutes());
	});
    $('.delete').click(function() {
		var agree=confirm("Are you sure you want to delete?");
		if (agree)
			return true;
		else
			return false;
		});
	});
