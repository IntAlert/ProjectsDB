app.factory('ResearchesService', function($http, DedupeService) {

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

	}

	instance.query = function(query) {

	}

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
		}

		dataFormatted.Theme.Theme = research.Theme.map(function(t){return t.id})
		dataFormatted.Research.project_id = project_id

		return dataFormatted;

	}


	function updateTotals() {

		var totals = {
			count: instance.items.length
		};

		var themes = []

		angular.forEach(instance.items, function(item) {

			themes = themes.concat(item.Theme)

		});

		totals.themes = DedupeService.themes(themes)

		instance.totals = totals

	}


  return instance

});
