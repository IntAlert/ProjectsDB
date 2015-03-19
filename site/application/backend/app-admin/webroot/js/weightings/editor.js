$(function(){



	// activate checkboxes
	$('input.weighting').change(function() {

		// get new value
		var weighting = $(this).is(":checked");

		// get persona id
		var persona_id = $(this).data('persona-id');

		// get questionoption id
		var questionoption_id = $(this).data('questionoption-id');

		$.post('/admin/weightings/modify.json', {
			'persona_id' : persona_id,
			'questionoption_id' : questionoption_id,
			'weighting' : weighting

		}, function(response){
			console.log(response);
		});


		// update balance
		calculatePersonaBalance();

		// check all quesitons used
		checkQuestionOptionUse();

	});



	calculatePersonaBalance();
	checkQuestionOptionUse();
})



function calculatePersonaBalance() {



	var total = 0;
	var personaTotals = {};
	var personaCount = 0;


	// collect counts
	$('input.weighting').each(function(){

		var checked = $(this).is(':checked');
		var persona_id = $(this).data('persona-id');

		if (checked) {
			// add to total
			total++;

			// add to personCounts
			if ( !personaTotals.hasOwnProperty(persona_id) ) {
				personaTotals[persona_id] = 0;
				personaCount++;
			}

			personaTotals[persona_id]++;
		}
		
	})

	// average
	var avg = total / personaCount;

	for ( persona_id in personaTotals) {
	    var total = personaTotals[persona_id];

	    var diff = Math.round(total-avg);

	    if (diff > 0) diff = "+" + diff;

	    // add balance
	    $("#balance-persona-" + persona_id).text(diff);
	}

	// console.log(personaCounts);
}


function checkQuestionOptionUse() {
	$("tr.questionoption").each(function(){

		$tr = $(this);

		// check at least one checkbox selected
		if ($tr.find('input:checked').length == 0) {
			$tr.addClass('no-checks');
		} else {
			$tr.removeClass('no-checks');
		}

	})
}