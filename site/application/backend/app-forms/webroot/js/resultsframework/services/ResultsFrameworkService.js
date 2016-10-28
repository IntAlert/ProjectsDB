app.factory('ResultsFrameworkService', function($http) {

	var instance = {
		record: {
	  		themes: {
  				items: []
  			},
  			pathways: {
  				primary: null,
  				secondary: null
  			},
	  		dialogues: {
	  			meetings: {
	  				items: []
	  			},
	  			processes: {
	  				items: []
	  			}
	  		},
	  		grography: {
	  			countries: [],
		  		regions: []
	  		},
	  		trainings: {
	  			items: [],
	  			totals: {}
	  		},
			accompaniments: {
	  			items: [],
	  			totals: {}
	  		},
			advocacies:{
	  			items: [],
	  			totals: {}
	  		},
			researches: {
				items: [],
	  			totals: {}
			},
			results: {
				items: [],
				totals: {}
			}
		}
	}

	instance.save = function() {
		var project_id = 160;
		// NB. saving goes via /forms not /api
		return $http.post('/forms/resultsframework/save/' + project_id, instance.record)
	};

	instance.get = function(project_id) {
		// NB. saving goes via /api not /forms
		return $http.get('/api/resultsframework/view/' + project_id)
			.then(function(response){
				console.log(response)
				instance.record = response.data.data
			}, function(){
				alert("resultsframework download error")
			});
	}

  return instance

});
