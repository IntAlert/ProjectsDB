$(function(){
	$(".datepicker").datepicker({ 
		dateFormat: "dd/mm/yy",
		onSelect: function() {
			$(this).valid()
		}
	})

	

	// init validation plugin
	var validator = $("#TravelapplicationAddForm").validate({
		// debug: true,
		onfocusout: function (element) {
	        $(element).valid();
	    },
	    onfocusin: function (element) {
	        $(element).valid();
	    },
		// ignore: ":hidden, .ui-datepicker-year, .ui-datepicker-month",
		errorElement: 'span',
        errorElementClass: 'input-validation-error',
        errorClass: 'field-validation-error',
		errorContainer: $("#warning, #summary"),
		errorPlacement: function(error, element) {
			error.appendTo($(element).parents(".input"));
		},
		submitHandler: function(form) {
			
			// handle parent form submission
			// if (finalChecks()) {
			// 	// // no inconsistencies, or
			// 	// // user happy with any that exist

			// 	// // remove templates
			// 	// $(".component-contracts .template").remove();

			// 	// // re-enable
			// 	// $(".ui-buttonset-disabled").buttonset('enable');

			// 	// // set unsaved changes to false and let the save go ahead
			// 	// // ref. edit.unsaved.js
			// 	// changesUnsaved = false;

			// 	// // show dialog
				
			// 	// $("#dialog-project-save").dialog({
			// 	// 	closeOnEscape: false,
			// 	// 	dialogClass: "no-titlebar",
			// 	// 	modal:true
			// 	// })

			// 	// form.submit()
			// }


			
			
		},
		success: function(label) {
			// // tick
			label.addClass("input-validation-success");
			
		},

		highlight: function(element, errorClass) {
			$(element)
				.siblings(".field-validation-error")
				.removeClass('input-validation-success');
		},
		rules: {

			"data[Travelapplication][role_text]": {
				required: true,
				minlength: 3,
				maxlength: 200
			},

			"data[Travelapplication][summary]": {
				required: true,
				minlength: 3,
				maxlength: 200
			},

			"data[Travelapplicationitinerary][risks][]": {
				"itineraryRisks": true
			},

			"data[Travelapplicationitinerary][start_date][]": {
				"itineraryDate": true
			},

			"data[Travelapplicationitinerary][end_date][]": {
				"itineraryDate": true
			},

			"data[Travelapplication][convenant_agreed]": {
				required: true
			},

			"data[Travelapplication][policy_understood]": {
				required: true
			},

			"data[Travelapplication][evacuation_understood]": {
				required: true
			},

			"data[Travelapplication][conduct_understood]": {
				required: true
			},

			"data[Travelapplication][countrymanager_notified]": {
				required: true
			}
			
		}, 
	
		"messages": {
			"data[Travelapplication][convenant_agreed]": "Please check this box",
			"data[Travelapplication][policy_understood]": "Please check this box",
			"data[Travelapplication][evacuation_understood]": "Please check this box",
			"data[Travelapplication][conduct_understood]": "Please check this box",
			"data[Travelapplication][countrymanager_notified]": "Please check this box"
		}
	
	});

	// only allow inputs if destination set
	$('.itinerary-dest').keyup(function(){

		var allowOtherInputs = !! $(this).val().trim().length
		var otherInputs = $(this).parents('tr')
			.find('.itinerary-start-date, .itinerary-end-date, .itinerary-risk-level, .itinerary-risks')


		// update valid status of fields
		otherInputs.valid()

		if (allowOtherInputs) {
			otherInputs.attr('disabled', false)
		} else {
			otherInputs.attr('disabled', true)				
		}



	}).keyup();

})


jQuery.validator.addMethod("itineraryDate", function(value, element) {
  
  // must be valid date if dest is non-empty
  var destination = $(element).parents('tr').find('.itinerary-dest')
  var this_date = $(element)

  if (destination.val().trim()) {
  	return !! ValidateUKDate(this_date.val().trim())
  } else return true

}, 'Please enter a valid date.');

jQuery.validator.addMethod("itineraryRisks", function(value, element) {
  
  // must have value if dest does
  var destination = $(element).parents('tr').find('.itinerary-dest')
  var risks = $(element)

  if (destination.val().trim()) {
  	return !! risks.val().trim().length
  } else return true

}, 'Please list risks or type "none".');


function ValidateUKDate(dateStr) { 
	// based on http://stackoverflow.com/questions/6900530/validating-a-uk-date-using-javascript-jquery
    dateStr = dateStr.split("/");
    var newDate = new Date(dateStr[2], dateStr[1] - 1, dateStr[0]);
    var result = newDate.getDate() == Number(dateStr[0]) && newDate.getMonth() == Number(dateStr[1]) - 1? newDate : false;
    console.log(result)
    return result;
}
