$(function(){


	// udate pipeline year
	$("#selectedYear").change(function(){
		var selectedYear = $(this).val();
		window.location.href = '/pdb/contracts/pipeline?selectedYear=' + selectedYear;
	});
	
})