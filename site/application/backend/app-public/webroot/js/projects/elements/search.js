$(function(){

	$('#ProjectStartDate').datepicker({dateFormat: 'dd/mm/yy'});
	$('#ProjectFinishDate').datepicker({dateFormat: 'dd/mm/yy'});

	// reset all fields
	$('.project-search2 .reset').click(function(){
		$(this)
			.parents("form")
			.find("select,input[type!=submit]")
			.val("");


		// refresh jQuery UI
		$(".project-search2 select").selectmenu("refresh");

		return false;
	})

	 $(".project-search2 select").selectmenu({width:"100%"});


	 // three

	 $('#ProjectStartDate').datepicker({dateFormat: 'dd/mm/yy'});
	$('#ProjectFinishDate').datepicker({dateFormat: 'dd/mm/yy'});

	// reset all fields
	$('.project-search3 .reset').click(function(){
		$(this)
			.parents("form")
			.find("select,input[type!=submit]")
			.val("");


		// refresh jQuery UI
		$(".project-search3 select").selectmenu("refresh");

		return false;
	})

	 $(".project-search3 select").selectmenu({width:"100%"});



})