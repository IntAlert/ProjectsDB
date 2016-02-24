$(function(){
	// hide and override liklihood if status isn't submitted/not subitted
	var statusRadiosContainer = $(".input.radio.status");
	var likelihoodRadiosContainer = $(".input.radio.likelihood");

	likelihoodRadiosContainer.buttonset();
	statusRadiosContainer.buttonset();

	statusRadiosContainer.find('input').change(function(){

		// get selected option text
		var selectedStatusId = statusRadiosContainer.find(":checked").val();

		// these are the IDs used in the database for these statuses/likelihoods
		var statusIdApproved = 2;
		var statusIdOngoing = 9;
		var statusIdCompleted = 6;
		var statusIdRejected = 4;
		var statusIdCancelled = 10;
		var likelihoodIdLow = 4;
		var likelihoodIdConfirmed = 2;


		if (selectedStatusId == statusIdApproved || selectedStatusId == statusIdCompleted || selectedStatusId == statusIdOngoing) {
			// select 'confirmed' likelihood
			var likelihoodToPreselect = $(likelihoodRadiosContainer.find('[value='+likelihoodIdConfirmed+']'));

			likelihoodToPreselect.prop('checked', true);

			// hide likehoods
			$(".input.radio.likelihood").buttonset('refresh');
			$(".input.radio.likelihood").buttonset('disable');

		} else if (selectedStatusId == statusIdRejected || selectedStatusId == statusIdCancelled) {
			// select 'low' likelihood
			// var likelihoodToPreselect = $(likelihoodRadiosContainer.find('[value='+likelihoodIdLow+']'));
	  
			// likelihoodToPreselect.prop('checked', true);

			// hide likehoods
			// $(".input.radio.likelihood").buttonset('refresh');
			$(".input.radio.likelihood").buttonset('disable');
		} else {
			// show likehood
			$(".input.radio.likelihood").buttonset('enable');
		}


	}).change();	
})

