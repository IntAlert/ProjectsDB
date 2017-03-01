$(function(){


  // $( "#ProjectOwnerUserId" ).selectmenu();

	// set up project dates
	
  

    // OTHER-DATES: SUBMISSION DATES
    $( ".other-dates .proposal .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectProposalDate" ).val(),
      yearRange: "-8:+10",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
        $( "#ProjectProposalDate" ).val(selectedDate);
      }
    });

    // OTHER-DATES: EVALUATION DATES
    $( ".other-dates .evaluation .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectEvaluationDate" ).val(),
      yearRange: "-1:+10",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
        $( "#ProjectEvaluationDate" ).val(selectedDate);
      }
    });

    // OTHER-DATES: SUBMISSION DATES
    $( ".other-dates .reporting .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectReportingDate" ).val(),
      yearRange: "-1:+10",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
        $( "#ProjectReportingDate" ).val(selectedDate);
      }
    });

    

    // handle proposal required checkbox
    $("#ProjectProposalRequired").change(function(){
      
      // we're dealing with the selected option now
      if($(this).is(':checked')) {
          $(".other-dates .proposal .details").show()
      } else {
          $(".other-dates .proposal .details").hide()
      }
    }).change()

    // handle evaluation required checkbox
    $("#ProjectEvaluationRequired").change(function(){
      
      // we're dealing with the selected option now
      if($(this).is(':checked')) {
          $(".other-dates .evaluation .details").show()
      } else {
          $(".other-dates .evaluation .details").hide()
      }
    }).change()

    // handle reporting required checkbox
    $("#ProjectReportingRequired").change(function(){
      
      // we're dealing with the selected option now
      if($(this).is(':checked')) {
          $(".other-dates .reporting .details").show()
      } else {
          $(".other-dates .reporting .details").hide()
      }
    }).change()




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
