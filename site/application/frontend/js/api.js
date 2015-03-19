var api = {
	
	"getQuestions" : function(cb, cb_err){
		$.get('/api/questions.json', function(response){

			console.log(response);

			if (response.ok) {
				// return response
				cb(response.data);	
			} else {
				// return response
				cb_err(response.data);	
			}

			
		})
	},

	"getQuestionsHtml" : function(cb, cb_err){
		$.get('/api/questions.html', function(response){

			cb(response);	
			
		})
	},

	"makePrediction" : function(questionoption_ids, cb, cb_err){
		$.post('/api/predictions/make.json', {

			"questionoption_ids" : questionoption_ids

		}, function(response){

			console.log(response);

			if (response.ok) {
				// return response
				cb(response.data);	
			} else {
				// return response
				cb_err(response.data);	
			}
		})
	},
	"registerPrizeEntry" : function(persona_id, name, email, over_18, cb, cb_err){
		$.post('/api/prizeentries/register.json', {

			"persona_id" : persona_id,
			"name" : name,
			"email" : email,
			"over_18" : over_18

		}, function(response){

			console.log(response);

			if (response.ok) {
				// return response
				cb(response.data);	
			} else {
				// return response
				cb_err(response.data);	
			}
		})
	},
};