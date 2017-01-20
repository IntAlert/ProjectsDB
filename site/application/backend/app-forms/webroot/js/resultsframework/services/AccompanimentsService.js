app.factory('AccompanimentsService', function($http, $httpParamSerializer, $location, DedupeService) {

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

		// set API URLs
		instance.api_urls.csv = $location.protocol() + "://" + $location.host() + '/api/accompaniments/all.csv?' + $httpParamSerializer(queryParams);
		instance.api_urls.json = $location.protocol() + "://" + $location.host() + '/api/accompaniments/all?' + $httpParamSerializer(queryParams);

	}


	instance.query = function(query) {

		// set API URLs
		instance.updateApiUrls(query);
		
		return $http.get(instance.api_urls.json)
			.then(function(response){

				var accompaniments = response.data.data || []

				instance.items = accompaniments
				
				updateTotals()

			}, function(){
				alert("accompaniments download error")
			});
	}


	instance.load = function(a_project_id) {

		project_id = a_project_id;

		// NB. saving goes via /api not /forms
		return $http.get('/api/accompaniments/project/' + project_id)
			.then(function(response){

				var accompaniments = response.data.data || []

				instance.items = accompaniments
				
				updateTotals()

			}, function(){
				alert("accompaniments download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/accompaniments/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("accompaniments delete error")
			});
	}

	instance.create = function(accompaniment) {

		var dataFormatted = formatForSaving(accompaniment);

		return $http.post('/api/accompaniments/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("accompaniments create error")
			});
	}

	instance.update = function(accompaniment) {

		var dataFormatted = formatForSaving(accompaniment);

		return $http.post('/api/accompaniments/update/' + accompaniment.Accompaniment.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("accompaniments update error")
			});
	}



	// Private functions
	function formatForSaving(accompaniment) {

		var dataFormatted = {
			Accompaniment: accompaniment.Accompaniment,
			AccompanimentParticipantCount: [] // HM
		}

		// build AccompanimentParticipantCount for saving
		for(participant_type_id in accompaniment.participant_type_counts) {
			var count = accompaniment.participant_type_counts[participant_type_id]
			dataFormatted.AccompanimentParticipantCount.push({
				count: count,
				participant_type_id:participant_type_id
			})
		}
		
		dataFormatted.Accompaniment.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {
  		var totals = {
  			participant_type_counts: {}
  		}

		// loop through all items
		angular.forEach(instance.items, function(item) {

			// loop through all participant types
			for(participant_type_id in item.participant_type_counts) {
				var count = item.participant_type_counts[participant_type_id]

				if ( !totals.participant_type_counts.hasOwnProperty(participant_type_id) ) {
					totals.participant_type_counts[participant_type_id] = 0
				}

				totals.participant_type_counts[participant_type_id] += count;

			}

		});

		instance.totals = totals;
	}


  return instance

});
