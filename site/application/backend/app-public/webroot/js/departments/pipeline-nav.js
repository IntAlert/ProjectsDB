$(function(){

	$("#selectedYear").selectmenu({width:'100%'});

	// udate pipeline year
	$("#selectedYear").change(function(){
		var selectedYear = $(this).val();
		window.location.href = '?selectedYear=' + selectedYear;
	});
	
})