$(function(){


	// udate pipeline year
	$("#selectedYear").change(function(){
		var selectedYear = $(this).val();
		window.location.href = '?selectedYear=' + selectedYear;
	});
	
})