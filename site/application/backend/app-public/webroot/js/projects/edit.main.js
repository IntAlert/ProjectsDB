$(function(){


  // $( "#ProjectOwnerUserId" ).selectmenu();

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

        // ensure project finish date is valid
        $( ".timespan .finish .datepicker-placeholder" ).datepicker( "option", "minDate", selectedDate );

        if (Date.parse($( "#ProjectFinishDate" ).val()) < Date.parse(selectedDate)) {
          // finish date invalid
          // jquery UI datepicker updates its date but not the hidden field,
          // so do it manually
          $( "#ProjectFinishDate" ).val(selectedDate);

        }

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
      }
    });

    // ensure project finish date is restricted
    // $( ".timespan .start .datepicker-placeholder" ).datepicker( "option", "maxDate", $( ".timespan .finish .datepicker-placeholder" ).datepicker("getDate") );
    $( ".timespan .finish .datepicker-placeholder" ).datepicker( "option", "minDate", $( ".timespan .start .datepicker-placeholder" ).datepicker("getDate") );


    // Summary: limit word count, autogrow
    $("#ProjectSummary, #ProjectBeneficiaries, #ProjectLocation, #ProjectGoals, #ProjectObjectives")
      .each(function(){

        $(this).counter({
          type: 'word',
          goal: 300
        })
        .autoGrow();  
      })
    
	
})