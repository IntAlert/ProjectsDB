$(function(){


  // $( "#ProjectOwnerUserId" ).selectmenu();

	// set up project dates
	
  // TIMESPAN: START
    $( ".timespan .start .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectStartDate" ).val(),
      yearRange: "-8:+10",
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

        updateTimespanInMonths();

      }
    });

    // FINISH
    $( ".timespan .finish .datepicker-placeholder" ).datepicker({
      defaultDate: $( "#ProjectFinishDate" ).val(),
      changeMonth: true,
      changeYear: true,
      yearRange: "-8:+10",
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
      	$( "#ProjectFinishDate" ).val(selectedDate);
        updateTimespanInMonths();
      }
    });

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

    // ensure project finish date is restricted
    // $( ".timespan .start .datepicker-placeholder" ).datepicker( "option", "maxDate", $( ".timespan .finish .datepicker-placeholder" ).datepicker("getDate") );
    $( ".timespan .finish .datepicker-placeholder" )
        .datepicker( "option", "minDate", $( ".timespan .start .datepicker-placeholder" ).datepicker("getDate") );


    // handle project finish extension
    $("[name='data[Project][finish_extended]']").change(function(){
      
      // ignore this change if this radio button not checked:
      if ( !$(this).is(':checked') ) return;

      // we're dealing with the selected option now
      if (this.value == 0) {
          $(".project-extension-block").hide()
      } else {
          $(".project-extension-block").show()
      }
    }).change()

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
      
    updateTimespanInMonths();
    
	
})

function updateTimespanInMonths() {
  var start = $( "#ProjectStartDate" ).val();
  var finish = $( "#ProjectFinishDate" ).val();
  var months = (Date.parse(finish) - Date.parse(start)) / (60 * 60 * 24 * 365 * 1000 / 12);
  $(".timespan-in-months").text(months.toFixed(1) + " month(s)")
}