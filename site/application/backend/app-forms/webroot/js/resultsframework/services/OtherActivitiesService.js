app.factory('OtherActivitiesService', function($http, $location, $httpParamSerializer, DedupeService) {

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
		instance.api_urls.csv = $location.protocol() + "://" + $location.host() + '/api/other_activities/all.csv?' + $httpParamSerializer(queryParams);
		instance.api_urls.json = $location.protocol() + "://" + $location.host() + '/api/other_activities/all?' + $httpParamSerializer(queryParams);
	}

	instance.query = function(query) {
		// set API URLs
		instance.updateApiUrls(query);

		return $http.get(instance.api_urls.json)
			.then(function(response){

				var other_activities = response.data.data || []

				instance.items = other_activities
				
				updateTotals()

			}, function(){
				alert("other_activities download error")
			});
	}

	instance.load = function(a_project_id) {

		project_id = a_project_id;

		// NB. saving goes via /api not /forms
		return $http.get('/api/OtherActivities/project/' + project_id)
			.then(function(response){

				var otheractivities = response.data.data || []

				instance.items = otheractivities
				
				updateTotals()

			}, function(){
				alert("otheractivities download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/OtherActivities/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("otheractivities delete error")
			});
	}

	instance.create = function(otheractivity) {

		var dataFormatted = formatForSaving(otheractivity);

		return $http.post('/api/OtherActivities/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("otheractivities delete error")
			});
	}

	instance.update = function(otheractivity) {

		var dataFormatted = formatForSaving(otheractivity);

		return $http.post('/api/OtherActivities/update/' + otheractivity.OtherActivity.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("otheractivities delete error")
			});
	}



	// Private functions
	function formatForSaving(otheractivity) {

		var dataFormatted = {
			OtherActivity: otheractivity.OtherActivity,
			ParticipantType: {ParticipantType: []}, // HABTM
		}

		dataFormatted.ParticipantType.ParticipantType = otheractivity.ParticipantType.map(function(pt){return pt.id})
		dataFormatted.OtherActivity.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {

		var totals = {
			male_count: 0,
			female_count: 0,
			session_count: 0
		}

		var themes = []
		var participant_types = []

		// loop through all otheractivity items
		angular.forEach(instance.items, function(item) {

			totals.male_count += Number(item.OtherActivity.male_count)
			totals.female_count += Number(item.OtherActivity.female_count)
			totals.session_count++

  			participant_types = participant_types.concat(item.ParticipantType)

		});

		totals.participant_types = DedupeService.participantTypes(participant_types)

		instance.totals = totals;
	}


  return instance

});
