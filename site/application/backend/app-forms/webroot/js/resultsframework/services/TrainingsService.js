app.factory('TrainingsService', function($http, $httpParamSerializer, $location, DedupeService) {

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


	instance.query = function(query) {

		// set API URLs
		instance.updateApiUrls(query);

		// Then run the query
		return $http.get(instance.api_urls.json)
			.then(function(response){

				var trainings = response.data.data || []

				instance.items = trainings
				
				updateTotals()

			}, function(){
				alert("trainings download error")
			});
	}

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

		// This function is used by query and edit pages
		// all of the above 

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
		instance.api_urls.csv = $location.protocol() + "://" + $location.host() + '/api/trainings/all.csv?' + $httpParamSerializer(queryParams);
		instance.api_urls.json = $location.protocol() + "://" + $location.host() + '/api/trainings/all?' + $httpParamSerializer(queryParams);
	}


	instance.load = function(a_project_id) {

		project_id = a_project_id;

		// NB. saving goes via /api not /forms
		return $http.get('/api/trainings/project/' + project_id)
			.then(function(response){

				var trainings = response.data.data || []

				instance.items = trainings
				
				updateTotals()

			}, function(){
				alert("trainings download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/trainings/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("trainings delete error")
			});
	}

	instance.create = function(training) {

		var dataFormatted = formatForSaving(training);

		return $http.post('/api/trainings/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("trainings delete error")
			});
	}

	instance.update = function(training) {

		var dataFormatted = formatForSaving(training);

		return $http.post('/api/trainings/update/' + training.Training.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("trainings delete error")
			});
	}



	// Private functions
	function formatForSaving(training) {

		var dataFormatted = {
			Training: training.Training,
			Theme: {Theme: []}, // HABTM
			ParticipantType: {ParticipantType: []}, // HABTM
		}

		dataFormatted.Theme.Theme = training.Theme.map(function(t){return t.id})
		dataFormatted.ParticipantType.ParticipantType = training.ParticipantType.map(function(pt){return pt.id})
		dataFormatted.Training.project_id = project_id

		return dataFormatted;

	}

	function updateTotals() {

		var totals = {
			'event_count': 0,
			'male_count': 0,
			'female_count': 0,
			'transgender_count': 0
		}

		var themes = []
		var participant_types = []

		angular.forEach(instance.items, function(item) {
			this.event_count++
  			this.male_count += Number(item.Training.male_count)
  			this.female_count += Number(item.Training.female_count)
  			this.transgender_count += Number(item.Training.transgender_count)


  			themes = themes.concat(item.Theme)
  			participant_types = participant_types.concat(item.ParticipantType)

		}, totals);

		totals.themes = DedupeService.themes(themes)
		totals.participant_types = DedupeService.participantTypes(participant_types)


		instance.totals = totals;
	}

  return instance

});
