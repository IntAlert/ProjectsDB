app.factory('ResearchesService', function($http, DedupeService) {

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
			Territory: {Territory: []}, // HABTM
		}

		dataFormatted.Theme.Theme = research.Theme.map(function(t){return t.id})
		dataFormatted.Territory.Territory = research.Territory.map(function(pt){return pt.id})
		dataFormatted.Research.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {

		var totals = {
			count: instance.items.length
		};

		var themes = []
		var territories = []

		angular.forEach(instance.items, function(item) {

			totals.male_count += Number(item.Research.male_count)
			totals.female_count += Number(item.Research.female_count)
			totals.female_trauma_count += Number(item.Research.female_trauma_count)
			totals.male_trauma_count += Number(item.Research.male_trauma_count)
			totals.meeting_count++
			totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

			themes = themes.concat(item.Theme)
  			territories = territories.concat(item.Territory)

		});

		totals.themes = DedupeService.themes(themes)
		totals.territories = DedupeService.territories(territories)

		instance.totals = totals

	}


  return instance

});
