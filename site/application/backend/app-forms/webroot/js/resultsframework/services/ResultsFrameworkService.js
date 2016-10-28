app.factory('ResultsFrameworkService', function($http) {



	var emptyRecordTemplate = {
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
  		geography: {
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

	var instance = {
		record: {}
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
				
				console.log('Downloaded the record: ')
				console.log(angular.copy(response))

				var record = response.data.data || {}

				// merge this data with the template, in case any keys are missing
				for(key in emptyRecordTemplate) {
					if ( !record.hasOwnProperty(key) ) {
						record[key] = emptyRecordTemplate[key]
					}
				}

				console.log('After normalised: ')
				console.log(record)


				instance.record = record
			}, function(){
				alert("resultsframework download error")
			});
	}

  return instance

});
