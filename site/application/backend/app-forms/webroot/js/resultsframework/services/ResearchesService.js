app.factory('ResearchesService', function($http, $location, $httpParamSerializer, DedupeService) {

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
		if ( query.participant_types && !query.participant_types.all ) {
			queryParams.participant_type_id = query.participant_types.selected.ParticipantType.id
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

		// set API URLs
		instance.api_urls.csv = $location.protocol() + "://" + $location.host() + '/api/researches/all.csv?' + $httpParamSerializer(queryParams);
		instance.api_urls.json = $location.protocol() + "://" + $location.host() + '/api/researches/all?' + $httpParamSerializer(queryParams);
	}

	instance.query = function(query) {
		// set API URLs
		instance.updateApiUrls(query);

		return $http.get(instance.api_urls.json)
			.then(function(response){

				var researches = response.data.data || []

				instance.items = researches
				
				updateTotals()

			}, function(){
				alert("researches download error")
			});
	}

	instance.load = function(a_project_id) {

		project_id = a_project_id;

		// NB. saving goes via /api not /forms
		return $http.get('/api/researches/project/' + project_id)
			.then(function(response){

				var researches = response.data.data || []

				instance.items = researches
				
				updateTotals()

			}, function(){
				alert("researches download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/researches/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("researches delete error")
			});
	}

	instance.create = function(research) {

		var dataFormatted = formatForSaving(research);

		return $http.post('/api/researches/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("researches delete error")
			});
	}

	instance.update = function(research) {

		var dataFormatted = formatForSaving(research);

		return $http.post('/api/researches/update/' + research.Research.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("researches delete error")
			});
	}



	// Private functions
	function formatForSaving(research) {

		var dataFormatted = {
			Research: research.Research,
			Theme: {Theme: []}, // HABTM
		}

		dataFormatted.Theme.Theme = research.Theme.map(function(t){return t.id})
		dataFormatted.Research.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {

		var totals = {
			count: instance.items.length
		};

		var themes = []

		angular.forEach(instance.items, function(item) {

			themes = themes.concat(item.Theme)

		});

		totals.themes = DedupeService.themes(themes)

		instance.totals = totals

	}


  return instance

});
