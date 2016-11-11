app.factory('ResultsFrameworkService', function($location, TrainingsService, ResearchesService) {



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

	// selected Project Id
	var projectId = null;


	// Build instance to return
	var instance = {
		record: {}
	}

	// instance.save = function() {
	// 	// NB. saving goes via /forms not /api
	// 	return $http.post('/forms/resultsframework/save/' + project_id, instance.record)
	// };

	// instance.load = function(a_project_id) {

	// 	project_id = a_project_id;

	// 	// NB. saving goes via /api not /forms
	// 	return $http.get('/api/resultsframework/view/' + project_id)
	// 		.then(function(response){
				
	// 			console.log('Downloaded the record: ')
	// 			console.log(angular.copy(response))

	// 			var record = response.data.data || {}

	// 			// merge this data with the template, in case any keys are missing
	// 			for(key in emptyRecordTemplate) {
	// 				if ( !record.hasOwnProperty(key) ) {
	// 					record[key] = emptyRecordTemplate[key]
	// 				}
	// 			}

	// 			console.log('After normalised: ')
	// 			console.log(record)


	// 			instance.record = record
	// 		}, function(){
	// 			alert("resultsframework download error")
	// 		});
	// }

	instance.load = function() {

		// determine project id
		var path = $location.url()
		var parts = path.split('/')
		if (parts[4]) {
			projectId = parts[4];
		} else {
			// this should not happen
			alert('Error determining project id from path: ' + path)
		}

		if(projectId) {
			TrainingsService.load(projectId)
			ResearchesService.load(projectId)
		}


	}

  return instance

});
