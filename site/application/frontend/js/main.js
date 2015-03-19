$(function(){


	api.getQuestionsHtml(function(data){

		// add them to the page
		$('.questions').html(data);


		// allow start to be clicked
		$('#btn-start').click(function(){

			// hide the button
			$(this).css('visibility', 'hidden')

			$('.intro').fadeOut('fast', function(){

				$(".question:first").fadeIn('fast', function(){
					// make progress bar visible
					// $(".progress").css('visibility', 'visible');
				});

				app.currentQuestionIndex = 1;

			})

			return false
		})

		// answering
		$(".question input.answer").change(function(){



			// go to next if questionIndex less than 10
			// next();

			// enable next button
			$(this).parents('.question').find('.next').removeClass('disabled');

			// otherwise, show get results
		});


		


		$("#btn-share").click(function(){

			// get avatar id
			var avatarId = $(this).data('avatar-id');

			// get share href
			var shareHref = $(this).data('share-href');
			

			FB.ui({
			  method: 'share',
			  href: shareHref,
			}, function(response){
				console.log(response);

				if (typeof response !== 'undefined') {
					$(".results-cta").fadeOut('fast', function(){
						$(".prize-form").fadeIn('fast');	
					});
					
				}
			});

			return false
		})

		// activate next button
		$('.home .next').click(function(){

			// check not disabled
			if ($(this).hasClass('disabled')) return false;

			next();
		})

		// activate next button
		$('.home .prev').click(function(){

			// check not disabled
			if ($(this).hasClass('disabled')) return false;

			prev();
		})


		// show intro
		$('.init-loading').fadeOut('fast', function(){
			$('.home .intro').fadeIn('fast');	
		});
		

	})

	

})


function next() {

	if (app.currentQuestionIndex == 10) {

		// build questionoption_ids
		var questionoption_ids = [];
		$('.answer:checked').each(function(){
			questionoption_ids.push($(this).val());
		})

		// save responses
		api.makePrediction(questionoption_ids, showResults, showResultsError);

		// TODO: show waiting
		showResultsWaiting();
		

		return;
	}



	// show next
	show(app.currentQuestionIndex + 1);



}

function prev() {


	show(app.currentQuestionIndex - 1);



}

function show(index, cb) {
	$("#question-" + app.currentQuestionIndex).fadeOut('fast', function(){

		// update current question
		app.currentQuestionIndex = index;

		$("#question-" + app.currentQuestionIndex).fadeIn('fast', function(){

			// callback?

		})	
	})

	updateButtons();
}

function updateButtons() {
	$('.question').each(function(){

		// get index
		var questionIndex = $(this).data('question-index');

		// get buttons
		var btnPrev = $(this).find('.prev');
		var btnNext = $(this).find('.next');

		// enable all previous buttons
		btnPrev.removeClass('disabled');

		// disable first prev
		if (questionIndex == 1) {
			btnPrev.addClass('disabled');
		}

		// has the question been answered?
		if($(this).find('.answer:checked').length > 0) {
			btnNext.removeClass('disabled');
		}

		// disable last next
		if (questionIndex == 10) {
			btnNext.addClass('disabled');
		}

	});
}


function showResultsWaiting() {

	$(".questions .question").hide();

	$(".controls").hide();

	$(".results-waiting").show();

}
function showResults(persona) {

	app.persona_id = persona.Persona.id;

	var target = $('.results-cta');

	target.find('h2').text('You are ' + persona.Persona.name);

	// description
	target.find('p.description').text(persona.Persona.description);

	// share href
	target.find('#btn-share').attr('data-share-href', persona.Persona.shareable_url );

	// image
	target.find('img').attr('src', "/img/personas/"+persona.Persona.image_url );	
	

	$(".results-waiting").hide();

	$(".results-cta").show();
}

function showResultsError(data) {
	//
	alert("There was an error");

}
