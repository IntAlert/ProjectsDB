// extend the current rules with new groovy ones

// // this one requires the text "buga", we define a default message, too
// $.validator.addMethod("buga", function(value) {
// 	return value == "buga";
// }, 'Please enter "buga"!');

// // this one requires the value to be the same as the first parameter
// $.validator.methods.equal = function(value, element, param) {
// 	return value == param;
// };

$(function(){

	// apply validator to appropriate form
	var form = $("#ProjectEditForm").length ? $("#ProjectEditForm") : $("#ProjectAddForm");

	var validator = $("#ProjectAddForm").validate({
			// debug: true,
			ignore: ":hidden, .ui-datepicker-year",
			errorElement: 'span',
	        errorElementClass: 'input-validation-error',
	        errorClass: 'field-validation-error',
			errorContainer: $("#warning, #summary"),
			// errorPlacement: function(error, element) {
			// 	error.appendTo(element.parents("input"));
			// },
			submitHandler: function(form) {
				
				// handle parent form submission, remove templates
				$(".component-contracts .template").remove();

				form.submit();
			},
			success: function(label) {
				// tick
				label.html("&#10004;").addClass("input-validation-success");
			},
			rules: {
				"data[Project][title]": {
					required: true,
					minlength: 3,
					maxlength: 100
				},

				"data[Project][summary]": {
					required: true,
					minlength: 30
				},

				"data[Project][programme_id]": {
					required: true
				},

				"data[Project][value_required]": {
					required: true,
					number: true
				},
			}
		});


		function addValidationRulesToContracts(){
			
			// get contracts that are not template
			var $contracts = $(".component-contracts").find(".contract:not(.template)");

			if ($contracts.length == 0) return;

			$contracts.find(".contract-donor-id").rules("add", { 
			  required:true,
			  number: true
			});

			$contracts.find(".contract-donor-currency").rules("add", { 
			  required:true
			});

			$contracts.find(".contract-summary").rules("add", { 
			  required:true
			});
			

			$contracts.find(".value_donor_currency").rules("add", { 
			  required:true,
			  number: true
			});

			$contracts.find(".value_gbp").rules("add", { 
			  required:true,
			  number: true
			});

		}

		// on contract creation, add validation rules
		// add rules for contracts
		$(".component-contracts").on('fields-added', addValidationRulesToContracts);

		// add rules for existing contracts
		addValidationRulesToContracts()



})

