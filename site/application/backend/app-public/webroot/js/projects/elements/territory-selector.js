$(function(){


	$(".territory-selector .input.radio").buttonset()
	$(".territory-selector .input.select").buttonset()


	// handle department change
	$(".territory-selector .department .input.radio").change(function(){

		// get selected input
		var selectedInput = $(".territory-selector .department .input.radio :checked");

		// get selected value
		var selectedDepartmentId = selectedInput.val();

		// get label
		var label = $("label[for='"+ selectedInput.attr('id') + "']");


		// if department name is EP, PIP, PAU:
		var departmentName = label.text().toUpperCase();

		if (departmentName == 'EMERGING PROGRAMMES' || departmentName == 'PIP' ||  departmentName == 'PAU' ||  departmentName == 'THE HAGUE' ||  departmentName == 'CORE GRANT') {
			// show all
			$(".territory-selector .territory-checkbox").show();

		} else {
			// otherwise,
			// hide all 
			$(".territory-selector .territory-checkbox").hide();

			// show just the right ones.
			$(".territory-selector .territory-checkbox").each(function(){

				var $div = $(this);
				var departmentIdsCsv = $($div.find('input')).data('department-ids-csv');
				var departmentIds = String(departmentIdsCsv).split(',');

				// console.log(selectedDepartmentId, departmentIds);

				if ($.inArray(selectedDepartmentId, departmentIds) > -1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			})

		}


	}).change();





})
