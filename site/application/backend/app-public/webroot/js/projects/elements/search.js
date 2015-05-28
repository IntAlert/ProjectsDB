$(function(){



	// reset all fields
	$('.project-search .reset').click(function(){
		$(this)
			.parents("form")
			.find("select,input[type!=submit]")
			.val("");
		return false;
	})


	 // $('.project-search select').selectmenu()





})