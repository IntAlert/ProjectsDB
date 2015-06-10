$(function(){

	// hide and override liklihood if status isn't submitted/not subitted
	$("#ProjectStatusId").change(function(){

		// var get likelihood list
		var likelihoodRadios = $(".input.radio.likelihood");

		// get selected option text
		var selTxt = $(this).find("option:selected").text()

		if (selTxt == 'Approved' || selTxt == 'Contracted' || selTxt == 'Completed') {
			// select 'confirmed' likelihood
			var liklihoodToPreselect = $(".likelihood-option[value=2]");
			liklihoodToPreselect.prop('checked', true);

			// hide likehoods
			likelihoodRadios.css('visibility', 'hidden');
		} else if (selTxt == 'Rejected') {
			// select 'low' likelihood
			var liklihoodToPreselect = $(".likelihood-option[value=4]");
			liklihoodToPreselect.prop('checked', true);

			// hide likehoods
			likelihoodRadios.css('visibility', 'hidden');
		} else {
			// hide likehood
			likelihoodRadios.css('visibility', 'visible');
		}


	}).change();


	// set up project timespan
	// START
    $( ".timespan .start .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectStartDate" ).val(),
      yearRange: "-5:+10",
      // changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
      	$( "#ProjectStartDate" ).val(selectedDate);
      	$( ".timespan .finish .datepicker-placeholder" ).datepicker( "option", "minDate", selectedDate );
      }
    });

    // FINISH
    $( ".timespan .finish .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectFinishDate" ).val(),
      // changeMonth: true,
      changeYear: true,
      yearRange: "-5:+10",
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
      	$( "#ProjectFinishDate" ).val(selectedDate);
      	$( ".timespan .start .datepicker-placeholder" ).datepicker( "option", "maxDate", selectedDate );
      }
    });

    // ensure timespan is restricted
    $( ".timespan .start .datepicker-placeholder" ).datepicker( "option", "maxDate", $( ".timespan .finish .datepicker-placeholder" ).datepicker("getDate") );
    $( ".timespan .finish .datepicker-placeholder" ).datepicker( "option", "minDate", $( ".timespan .start .datepicker-placeholder" ).datepicker("getDate") );


    // Summary: limit word count
    $("#ProjectSummary").counter({
      type: 'word',
      goal: 200
    });

    $("#ProjectSummary").autoGrow();

    // Summary: WYSIWYG
    // $("#test").wysiwyg();

  
	
})