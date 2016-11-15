app.factory('AdvocaciesService', function($http, DedupeService) {

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
		return $http.get('/api/advocacies/project/' + project_id)
			.then(function(response){

				var advocacies = response.data.data || []

				instance.items = advocacies
				
				updateTotals()

			}, function(){
				alert("advocacies download error")
			});
	}

	instance.delete = function(id) {
		return $http.post('/api/advocacies/delete/' + id)
			.then(function(response){

				instance.load(project_id)

			}, function(){
				alert("advocacies delete error")
			});
	}

	instance.create = function(advocacy) {

		var dataFormatted = formatForSaving(advocacy);

		return $http.post('/api/advocacies/create/', dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("advocacies create error")
			});
	}

	instance.update = function(advocacy) {

		var dataFormatted = formatForSaving(advocacy);

		return $http.post('/api/advocacies/update/' + advocacy.Advocacy.id, dataFormatted)
			.then(function(response){
				instance.load(project_id)
			}, function(){
				alert("advocacies update error")
			});
	}



	// Private functions
	function formatForSaving(advocacy) {

		var dataFormatted = {
			Advocacy: advocacy.Advocacy,
			Theme: {Theme: []}, // HABTM
			AdvocacyParticipantCount: [] // HM
		}

		// build AdvocacyParticipantCount for saving
		for(participant_type_id in advocacy.participant_type_counts) {
			var count = advocacy.participant_type_counts[participant_type_id]
			dataFormatted.AdvocacyParticipantCount.push({
				count: count,
				participant_type_id:participant_type_id
			})
		}
		
		dataFormatted.Theme.Theme = advocacy.Theme.map(function(t){return t.id})
		dataFormatted.Advocacy.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {
  		var totals = {
  			male_count: 0,
  			female_count: 0,
  			participant_types: {}
  		}

  		var themes = []

		// loop through all items
		angular.forEach(instance.items, function(item) {

			// fe/male counts
			totals.male_count += Number(item.Advocacy.male_count)
			totals.female_count += Number(item.Advocacy.female_count)


			// NB... At the moment, we don't show this, so calc not right below
			
			// loop through all participant types
			// angular.forEach(item.participant_types, function(count, participant_type) {

			// 	if (count) {

			// 		if ( !totals.participant_types.hasOwnProperty(participant_type) ) {
			// 			totals.participant_types[participant_type] = 0
			// 		}
			// 	}

			// 	totals.participant_types[participant_type] += count

			// })

			themes = themes.concat(item.Theme)

		});

		totals.themes = DedupeService.themes(themes)


		instance.totals = totals;
	}


  return instance

});
