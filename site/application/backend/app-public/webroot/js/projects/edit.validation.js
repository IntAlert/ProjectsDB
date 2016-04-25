// extend the current rules with new groovy ones

$(function(){

	// apply validator to appropriate form
	var $form = $("#ProjectEditForm").length ? $("#ProjectEditForm") : $("#ProjectAddForm");



	var validator = $form.validate({
			// debug: true,
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
				if (finalChecks()) {
					// no inconsistencies, or
					// user happy with any that exist

					// remove templates
					$(".component-contracts .template").remove();

					// re-enable
					$(".ui-buttonset-disabled").buttonset('enable');

					// set unsaved changes to false and let the save go ahead
					// ref. edit.unsaved.js
					changesUnsaved = false;

					// show dialog
					
					$("#dialog-project-save").dialog({
						closeOnEscape: false,
						dialogClass: "no-titlebar",
						modal:true
					})

					form.submit()
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
					maxlength: 200
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

				"data[Pathway][Pathway][]": {
					required: true
				},
				

				"data[Project][status_id]": {
					required: true
				},

				"data[Project][likelihood_id]": {
					required: true
				},

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
			  required:true
			});

			$contracts.find(".contract-donor-currency").rules("add", { 
			  required:true
			});

			$contracts.find(".value_donor_currency").rules("add", { 
			  required:true,
			  number: true
			});

			$contracts.find(".contract-category").rules("add", { 
			  required:true,
			  number: true
			});

			$contracts.find(".value_gbp").rules("add", { 
			  required:true,
			  number: true
			});

			$contracts.find(".contract-origin-total-value").rules("add", { 
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

			// if status changed to confirmed, remind to check project total
			var likelihood_id_confirmed = 2;
			var project_likelihood_submitted = Number($('[name="data[Project][likelihood_id]"]:checked').val());
			

			//
			if (
				(project_likelihood_original != project_likelihood_submitted)
				&& (project_likelihood_submitted == likelihood_id_confirmed)
				) {
			
				var checked_project_total = confirm('You have changed the likelihood of this project to CONFIRMED. Have you ensured that the project total value is accurate?');

				if (!checked_project_total) {
					return false;
				}
			}			

			return true;

		}

		function checkContractsMinimumRequirements() {

			var $contracts = $(".component-contracts").find(".contract:not(.template)");

			// check at least one contract
			if ($contracts.length == 0) {
				alert("Please add at least one contract")
				return false
			}


			// check each contract has a budget for every year
			var start = Date.parse($( "#ProjectStartDate" ).val());
			var finish = Date.parse($( "#ProjectFinishDate" ).val());

			var startYear = start.toString("yyyy")
			var finishYear = finish.toString("yyyy")

			var missingAnnualBudget = 0;
			$contracts.each(function(contractBlock){
				$contractBlock = $(this);
				
				$contractBlock.each(function(){

					for (var y = startYear; y <= finishYear; y++) {

						if ($contractBlock.find('.year[value="' + y + '"]').length == 0) {
							missingAnnualBudget++
						}		

					}

				})
			})

			if (missingAnnualBudget > 0) {
				alert('The annual budgets for each contract need to cover the entire project timespan')
				return false;	
			}

			// check no budgets for years outside timespan
			var tooManyBudgets = 0;
			$contracts.find('input.year').each(function(){
				var year = $(this).val()
				if ( !(year >= startYear && year <= finishYear) ) {
					tooManyBudgets++
				}
			})
			
			if (tooManyBudgets > 0) {
				alert('At least one of your contract budgets covers a year outside of the project timespan. Please correct.')
				return false;
			}
			
					

			// all must have been fine
			return true;


		}

		function finalChecks() {

			if (checkForInconsistencies() == false) {
				return false
			} else if ( checkContractsMinimumRequirements() == false) {
				return false
			}
			return true


		}

		// on contract creation, add validation rules
		// add rules for contracts
		$(".component-contracts").on('fields-added', addValidationRulesToContracts);

		// add rules for existing contracts
		addValidationRulesToContracts()

})

