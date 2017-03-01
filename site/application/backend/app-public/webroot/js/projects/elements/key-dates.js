$(function(){

// handle delete contract
	$(".component-key-dates").delegate(".btn-projectdate-delete", 'click', function(){

		var msg = 'Are you sure you want to delete this key project date?';

		if ( !confirm(msg) ) return false;

		// get TR
		var projectdateTr = $(this).parents('tr');

		deleteProjectdate(projectdateTr);

		return false;
	});

	// handle add contractbudget
	$(".component-key-dates").delegate(".btn-projectdate-add", 'click', function(){

		var newprojectTr = createProjectdate();

		return false;

	});

	$(".component-key-dates tr:not(.template) .project-date").each(function(){
		createDatePicker(this)
	})


});


function deleteProjectdate(projectdateTr) {

	// delete row
	projectdateTr.remove();

}

function createProjectdate() {

	// clone payment template
	var newprojectdateTrClone = $('.component-key-dates tr.template').clone();
	newprojectdateTrClone.removeClass('template');

	// get new payment id
	var new_projectnewdate_id = $(".component-key-dates").data("index-new-key-date-id");


	// update input names
	newprojectdateTrClone.find("input").each(function(){
		
		var inputName = $(this).attr('name');
		var newName = inputName
						.replace('{projectdate_id}', "new-projectdate-"+new_projectnewdate_id);

		$(this).attr('name', newName);

	});

	// increment payment id for new payments
	$(".component-key-dates").data("index-new-projectdate-id", new_projectnewdate_id+1)

	// payments
	var projectdatesTableBody = $('.component-key-dates table tbody');

	// append
	projectdatesTableBody.append(newprojectdateTrClone);	


	createDatePicker(newprojectdateTrClone.find('.project-date'))
	

	return newprojectdateTrClone

}

function createDatePicker(selector) {
	$( selector ).datepicker({
      // defaultDate: $( "#ProjectStartDate" ).val(),
      yearRange: "-2:+10",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: 'dd/mm/yy',
      onSelect: function(selectedDate) {
        // $( "#ProjectStartDate" ).val(selectedDate);

        // // ensure project finish date is valid
        // $( ".timespan .finish .datepicker-placeholder" ).datepicker( "option", "minDate", selectedDate );

        // if (Date.parse($( "#ProjectFinishDate" ).val()) < Date.parse(selectedDate)) {
        //   // finish date invalid
        //   // jquery UI datepicker updates its date but not the hidden field,
        //   // so do it manually
        //   $( "#ProjectFinishDate" ).val(selectedDate);

        // }

      }
    });
}