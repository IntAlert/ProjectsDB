$(function(){



	// activate checkboxes
	$('input.weighting').change(function() {

		// get new value
		var weighting = $(this).is(":checked");

		// get persona id
		var persona_id = $(this).data('persona-id');

		// get questionoption id
		var questionoption_id = $(this).data('questionoption-id');

		$.post('/api/weightings/modify.json', {
			'persona_id' : persona_id,
			'questionoption_id' : questionoption_id,
			'weighting' : weighting

		}, function(response){
			console.log(response);
		});

	});



})