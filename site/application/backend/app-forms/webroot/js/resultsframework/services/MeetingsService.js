app.factory('MeetingsService', function($http, DedupeService) {

	// Build instance to return
	var instance = {
		items: [],
		totals: {}
	}

	// selected Project Id
	var project_id = null;


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

			totals.male_count += item.male_count
			totals.female_count += item.female_count
			totals.female_trauma_count += item.female_trauma_count
			totals.male_trauma_count += item.male_trauma_count
			totals.meeting_count++
			totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

			themes = themes.concat(item.Theme)
  			participant_types = participant_types.concat(item.ParticipantType)

		});



		totals.themes = DedupeService.themes(themes)
		totals.participant_types = DedupeService.participantTypes(participant_types)

		instance.totals = totals;
	}


  return instance

});
