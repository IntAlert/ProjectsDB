app.factory('MeetingsService', function($http, DedupeService, $httpParamSerializer, $location) {

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
		instance.api_urls.csv = $location.protocol() + "://" + $location.host() + '/api/meetings/all.csv?' + $httpParamSerializer(queryParams);
		instance.api_urls.json = $location.protocol() + "://" + $location.host() + '/api/meetings/all?' + $httpParamSerializer(queryParams);
	}

	instance.query = function(query) {

		// set API URLs
		instance.updateApiUrls(query);

		return $http.get(instance.api_urls.json)
			.then(function(response){

				var meetings = response.data.data || []

				instance.items = meetings
				
				updateTotals()

			}, function(){
				alert("meetings download error")
			});
	}

	instance.load = function(a_project_id) {

		project_id = a_project_id;

		// NB. saving goes via /api not /forms
		return $http.get('/api/meetings/project/' + project_id)
			.then(function(response){

				var meetings = response.data.data || []

				instance.items = meetings
				
				updateTotals()

			}, function(){
				alert("meetings download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/meetings/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("meetings delete error")
			});
	}

	instance.create = function(meeting) {

		var dataFormatted = formatForSaving(meeting);

		return $http.post('/api/meetings/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("meetings delete error")
			});
	}

	instance.update = function(meeting) {

		var dataFormatted = formatForSaving(meeting);

		return $http.post('/api/meetings/update/' + meeting.Meeting.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("meetings delete error")
			});
	}



	// Private functions
	function formatForSaving(meeting) {

		var dataFormatted = {
			Meeting: meeting.Meeting,
			Theme: {Theme: []}, // HABTM
			ParticipantType: {ParticipantType: []}, // HABTM
		}

		dataFormatted.Theme.Theme = meeting.Theme.map(function(t){return t.id})
		dataFormatted.ParticipantType.ParticipantType = meeting.ParticipantType.map(function(pt){return pt.id})
		dataFormatted.Meeting.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {

		var totals = {
			male_count: 0,
			female_count: 0,
			meeting_count: 0,
			male_trauma_count: 0,
			female_trauma_count: 0,
			conflict_resolution: false
		}

		var themes = []
		var participant_types = []

		// loop through all meeting items
		angular.forEach(instance.items, function(item) {

			totals.male_count += Number(item.Meeting.male_count)
			totals.female_count += Number(item.Meeting.female_count)
			totals.female_trauma_count += Number(item.Meeting.female_trauma_count)
			totals.male_trauma_count += Number(item.Meeting.male_trauma_count)
			totals.meeting_count++
			totals.conflict_resolution = totals.conflict_resolution || item.Meeting.conflict_resolution

			themes = themes.concat(item.Theme)
  			participant_types = participant_types.concat(item.ParticipantType)

		});



		totals.themes = DedupeService.themes(themes)
		totals.participant_types = DedupeService.participantTypes(participant_types)

		instance.totals = totals;
	}


  return instance

});
