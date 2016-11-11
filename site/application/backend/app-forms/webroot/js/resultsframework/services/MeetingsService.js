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

				console.log(instance)

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
			'event_count': 0,
			'male_count': 0,
			'female_count': 0
		}

		var themes = []
		var participant_types = []

		angular.forEach(instance.items, function(item) {
			this.event_count++
  			this.male_count += Number(item.Meeting.male_count)
  			this.female_count += Number(item.Meeting.female_count)

  			themes = themes.concat(item.Theme)
  			participant_types = participant_types.concat(item.ParticipantType)

		}, totals);

		totals.themes = DedupeService.themes(themes)
		totals.participant_types = DedupeService.participantTypes(participant_types)


		instance.totals = totals;
	}

  return instance

});
