$(function(){

	$("#selectedYear").selectmenu({
		width:'100%',
		change: function(){
			var selectedYear = $(this).val();
			window.location.href = '?selectedYear=' + selectedYear;
		}
	});
	
})