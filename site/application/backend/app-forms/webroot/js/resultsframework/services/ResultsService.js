app.factory('ResultsService', function($http, DedupeService) {

	// Build instance to return
	var instance = {
		items: [],
		totals: {},

		api_urls: {
			csv: null,
			json: null
		}
	}

	// selected Project Id
	var project_id = null;

	instance.updateApiUrls = function(query) {

	}

	instance.query = function(query) {

	}

	instance.load = function(a_project_id) {

		project_id = a_project_id;

		// NB. saving goes via /api not /forms
		return $http.get('/api/results/project/' + project_id)
			.then(function(response){

				var results = response.data.data || []

				instance.items = results

			}, function(){
				alert("results download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/results/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("results delete error")
			});
	}

	instance.create = function(result) {

		var dataFormatted = formatForSaving(result);

		return $http.post('/api/results/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)

			}, function(){
				alert("results delete error")
			});
	}

	instance.update = function(result) {

		var dataFormatted = formatForSaving(result);

		return $http.post('/api/results/update/' + result.Result.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("results delete error")
			});
	}



	// Private functions
	function formatForSaving(result) {

		var dataFormatted = {
			Result: result.Result,
			Impact: {Impact: []}, // HABTM
		}

		dataFormatted.Impact.Impact = result.Impact.map(function(i){return i.id})
		dataFormatted.Result.project_id = project_id

		return dataFormatted;

	}



  return instance

});
