$(function(){

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


	function updateTimespanInMonths() {
	  var start = $( "#ProjectStartDate" ).val();
	  var finish = $( "#ProjectFinishDate" ).val();
	  var months = (Date.parse(finish) - Date.parse(start)) / (60 * 60 * 24 * 365 * 1000 / 12);
	  $(".timespan-in-months").text(months.toFixed(1) + " month(s)")
	}

	updateTimespanInMonths();


});
