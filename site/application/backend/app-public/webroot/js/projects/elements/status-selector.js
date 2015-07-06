$(function(){
	// hide and override liklihood if status isn't submitted/not subitted
	var statusRadiosContainer = $(".input.radio.status");
	var likelihoodRadiosContainer = $(".input.radio.likelihood");

	likelihoodRadiosContainer.buttonset();
	statusRadiosContainer.buttonset();

	statusRadiosContainer.find('input').change(function(){

		// get selected option text
		var selectedStatusId = statusRadiosContainer.find(":checked").val();

		var statusIdApproved = 3;
		var statusIdCompleted = 6;
		var statusIdRejected = 4;
		var likelihoodIdLow = 4;
		var likelihoodIdConfirmed = 2;


		if (selectedStatusId == statusIdApproved || selectedStatusId == statusIdCompleted) {
			// select 'confirmed' likelihood
			var liklihoodToPreselect = $(likelihoodRadiosContainer.find('[value='+likelihoodIdConfirmed+']'));

			liklihoodToPreselect.prop('checked', true);

			// hide likehoods
			$(".input.radio.likelihood").buttonset('refresh');
			$(".input.radio.likelihood").buttonset('disable');

		} else if (selectedStatusId == statusIdRejected) {
			// select 'low' likelihood
			var liklihoodToPreselect = $(likelihoodRadiosContainer.find('[value='+likelihoodIdLow+']'));
	  
			liklihoodToPreselect.prop('checked', true);

			// hide likehoods
			$(".input.radio.likelihood").buttonset('refresh');
			$(".input.radio.likelihood").buttonset('disable');
		} else {
			// show likehood
			$(".input.radio.likelihood").buttonset('enable');
		}


	}).change();	
})

