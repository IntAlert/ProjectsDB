$(function(){


  $( "#ProjectOwnerUserId" ).selectmenu();

	


	// set up project dates
	// SUBMISSION DATES
    $( ".timespan .submission .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectSubmissionDate" ).val(),
      yearRange: "-5:+10",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
        $( "#ProjectSubmissionDate" ).val(selectedDate);
      }
    });

  // START
    $( ".timespan .start .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectStartDate" ).val(),
      yearRange: "-5:+10",
      changeMonth: true,
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
      changeMonth: true,
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


    // Summary: limit word count, autogrow
    $("#ProjectSummary, #ProjectBeneficiaries, #ProjectLocation, #ProjectGoals, #ProjectObjectives")
      .each(function(){

        $(this).counter({
          type: 'word',
          goal: 200
        })
        .autoGrow();  
      })
      

    
    

  
	
})