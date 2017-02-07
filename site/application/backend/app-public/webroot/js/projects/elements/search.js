$(function(){

	$('#ProjectStartDate').datepicker({dateFormat: 'dd/mm/yy'});
	$('#ProjectFinishDate').datepicker({dateFormat: 'dd/mm/yy'});

	// reset all fields
	$('.project-search-left .reset').click(function(){
		$(this)
			.parents("form")
			.find("select,input[type!=submit]")
			.val("");


		// refresh jQuery UI
		$(".project-search-left select").selectmenu("refresh");

		return false;
	})

	$("#ProjectDonorId").multipleSelect({
        width: "100%"
    });

    $("#ProjectStatusId").multipleSelect({
        width: "100%"
    });

	 $(".export .btn").button();

})