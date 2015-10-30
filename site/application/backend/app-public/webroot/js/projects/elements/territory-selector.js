$(function(){


	$(".territory-selector .input.radio").buttonset()
	$(".territory-selector .input.select").buttonset()


	// handle programme change
	$(".territory-selector .programme .input.radio").change(function(){

		// get selected input
		var selectedInput = $(".territory-selector .input.radio :checked");

		// get selected value
		var selectedProgrammeId = selectedInput.val();

		// get label
		var label = $("label[for='"+ selectedInput.attr('id') + "']");


		// if programme name is EP, PIP:
		var programmeName = label.text().toUpperCase();

		console.log(programmeName);

		if (programmeName == 'EMERGING PROGRAMMES' && programmeName == 'PIP') {
			// show all
			$(".territory-selector .territory-checkbox").show();

		} else {
			// otherwise,
			// hide all 
			$(".territory-selector .territory-checkbox").hide();

			// show just the right ones.
			$(".territory-selector .territory-checkbox").each(function(){
				
				var $div = $(this);
				var programmeIdsCsv = $($div.find('input')).data('programme-ids-csv');
				var programmeIds = String(programmeIdsCsv).split(',');


				if ($.inArray(selectedProgrammeId, programmeIds) > -1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			})

		}


	}).change();





})
