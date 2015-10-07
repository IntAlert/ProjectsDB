// extend the current rules with new groovy ones

$(function(){

	// apply validator to appropriate form
	var $form = $("#ProjectEditForm").length ? $("#ProjectEditForm") : $("#ProjectAddForm");

	var validator = $form.validate({
			debug: true,
			onfocusout: function (element) {
		        $(element).valid();
		    },
		    onfocusin: function (element) {
		        $(element).valid();
		    },
			ignore: ":hidden, .ui-datepicker-year, .ui-datepicker-month",
			errorElement: 'span',
	        errorElementClass: 'input-validation-error',
	        errorClass: 'field-validation-error',
			errorContainer: $("#warning, #summary"),
			errorPlacement: function(error, element) {
				error.appendTo($(element).parents(".input"));
			},
			submitHandler: function(form) {
				
				// handle parent form submission
				if (checkForInconsistencies()) {
					// no inconsistencies, or
					// user happy with any that exist

					// remove templates
					$(".component-contracts .template").remove();

					// re-enable
					$(".ui-buttonset-disabled").buttonset('enable');

					form.submit();
				}
				
				
			},
			success: function(label) {
				// tick
				label.html("&#10004;").addClass("input-validation-success");

				// mark parent as correct
				$(label).parents('.input').addClass('validated');
				
			},

			highlight: function(element, errorClass) {
				$(element)
					.siblings(".field-validation-error")
					.removeClass('input-validation-success');
			},
			rules: {
				"data[Project][title]": {
					required: true,
					minlength: 3,
					maxlength: 100
				},

				"data[Project][summary]": {
					// required: true,
					// minlength: 30
				},

				"data[Project][beneficiaries]": {
					// required: true,
					// minlength: 30
				},

				"data[Project][location]": {
					// required: true,
					// minlength: 30
				},

				"data[Project][goals]": {
					// required: true,
					// minlength: 30
				},
				
				"data[Project][objectives]": {
					// required: true,
					// minlength: 30
				},


				"data[Project][department_id]": {
					required: true
				},

				"data[Project][programme_id]": {
					required: true
				},

				"data[Project][status_id]": {
					required: true
				},

				"data[Project][likelihood_id]": {
					required: true
				},

				// "data[Project][owner_user_id]": {
				// 	required: true,
				// 	minlength:1
				// },

				"data[Project][value_required]": {
					required: true,
					number: true
				}


				
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

			$contracts.find(".value_donor_currency").rules("add", { 
			  required:true,
			  number: true
			});

			$contracts.find(".value_gbp").rules("add", { 
			  required:true,
			  number: true
			});

		}

		function checkForInconsistencies() {
			// give the user an opportunity to abort

			// check for negative shortfall
			if ($(".shortfall .value_gbp").data('shortfall') < 0) {
				var ok_with_neg_sf = confirm('Are you sure you want to save? This project has a negative shortfall.');
				if (!ok_with_neg_sf) {
					return false;
				}
			}

			return true;

		}

		// on contract creation, add validation rules
		// add rules for contracts
		$(".component-contracts").on('fields-added', addValidationRulesToContracts);

		// add rules for existing contracts
		addValidationRulesToContracts()



})

