app.factory('ResultsService', function($http, $location, $httpParamSerializer, DedupeService) {

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
		

		var queryParams = {
			key: api_key // set in HTML document via PHP
		};

		// filter on date?
		if ( !query.dates.all ) {
			// correct for annoying timezone issue
			var start_date = query.dates.start.addMinutes(-new Date().getTimezoneOffset());
			var finish_date = query.dates.finish.addMinutes(-new Date().getTimezoneOffset());
			
			queryParams.start_date = start_date.toISOString().slice(0,10),
			queryParams.finish_date = finish_date.toISOString().slice(0,10)
		}

		// filter on participant type?
		if ( query.impacts && !query.impacts.all ) {
			queryParams.impact_id = query.impacts.selected.Impact.id
		}

		// filter on theme?
		if ( query.themes && !query.themes.all ) {
			queryParams.theme_id = query.themes.selected.Theme.id
		}

		// filter on department?
		if ( query.departments && !query.departments.all ) {
			queryParams.department_id = query.departments.selected.Department.id
		}

		// filter on territory?
		if ( query.territories && !query.territories.all ) {
			queryParams.territory_id = query.territories.selected.Territory.id
		}

		// filter on pathway?
		if ( query.pathways && !query.pathways.all ) {
			queryParams.pathway_id = query.pathways.selected.Pathway.id
		}

		// filter on project_id?
		if ( query.project_id ) {
			queryParams.project_id = query.project_id
		}

		// filter on project_id?
		if ( query.publication_approved_only ) {
			queryParams.publication_approved_only = 1
		}

		// set API URLs
		instance.api_urls.csv = $location.protocol() + "://" + $location.host() + '/api/results/all.csv?' + $httpParamSerializer(queryParams);
		instance.api_urls.json = $location.protocol() + "://" + $location.host() + '/api/results/all?' + $httpParamSerializer(queryParams);
	}

	instance.query = function(query) {
		
		// set API URLs
		instance.updateApiUrls(query);

		return $http.get(instance.api_urls.json)
			.then(function(response){

				var results = response.data.data || []

				instance.items = results

			}, function(){
				alert("results download error")
			});
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

	instance.approvePublication = function(result_id) {
		return $http.post('/api/results/approvePublication/' + result_id)
		.then(function(response){
			window.location.reload();
		}, function(){
			alert("results approve error")
		});
	}


	instance.blockPublication = function(result_id) {
		return $http.post('/api/results/blockPublication/' + result_id)
		.then(function(response){
			window.location.reload();
		}, function(){
			alert("results block error")
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
