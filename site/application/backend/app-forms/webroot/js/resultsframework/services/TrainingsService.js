app.factory('TrainingsService', function($http, DedupeService) {

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
		return $http.get('/api/trainings/project/' + project_id)
			.then(function(response){

				var trainings = response.data.data || []

				instance.items = trainings
				
				updateTotals()

				console.log(instance)

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
			'female_count': 0
		}

		var themes = []
		var participant_types = []

		angular.forEach(instance.items, function(item) {
			this.event_count++
  			this.male_count += Number(item.Training.male_count)
  			this.female_count += Number(item.Training.female_count)

  			themes = themes.concat(item.Theme)
  			participant_types = participant_types.concat(item.ParticipantType)

		}, totals);

		console.log(participant_types)
		console.log(themes)

		totals.themes = DedupeService.themes(themes)
		totals.participant_types = DedupeService.participantTypes(participant_types)


		instance.totals = totals;
	}

  return instance

});
