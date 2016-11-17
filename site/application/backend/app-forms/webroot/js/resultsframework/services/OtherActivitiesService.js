app.factory('OtherActivitiesService', function($http, DedupeService) {

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
		return $http.get('/api/otheractivities/project/' + project_id)
			.then(function(response){

				var otheractivities = response.data.data || []

				instance.items = otheractivities
				
				updateTotals()

			}, function(){
				alert("otheractivities download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/otheractivities/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("otheractivities delete error")
			});
	}

	instance.create = function(otheractivity) {

		var dataFormatted = formatForSaving(otheractivity);

		return $http.post('/api/otheractivities/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("otheractivities delete error")
			});
	}

	instance.update = function(otheractivity) {

		var dataFormatted = formatForSaving(otheractivity);

		return $http.post('/api/otheractivities/update/' + otheractivity.OtherActivity.id, dataFormatted)
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
