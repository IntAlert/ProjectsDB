$(function(){

	$('#ProjectStartDate').datepicker({dateFormat: 'dd/mm/yy'});
	$('#ProjectFinishDate').datepicker({dateFormat: 'dd/mm/yy'});

	// reset all fields
	$('.project-search .reset').click(function(){
		$(this)
			.parents("form")
			.find("select,input[type!=submit]")
			.val("");
		return false;
	})


	 // $('.project-search select').selectmenu()
	 $(".project-search2 .show-advanced").click(function(){
	 	$(".project-search2 .advanced").slideDown();
	 	
	 	$("#ProjectAdvanced").val(true);

	 	$(this).hide();

	 	return false;
	 })


	 $(".project-search2 select").selectmenu({width:"100%"});


})