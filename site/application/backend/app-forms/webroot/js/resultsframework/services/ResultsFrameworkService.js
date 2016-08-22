app.factory('ResultsFrameworkService', function($http) {
  var obj = {

  	save: function(data) {
  		var project_id = 160;
  		// NB. saving goes via /forms not /api
  		return $http.post('/forms/resultsframework/save/' + project_id, data)
			.then(function(response){
				return response
			}, function(){
				alert("resultsframework download error")
			});
  	},

  	get: function(project_id) {
  		// NB. saving goes via /api not /forms
		return $http.get('/api/resultsframework/view/' + project_id)
			.then(function(response){
				return response.data
			}, function(){
				alert("resultsframework download error")
			});
  	}

  }

  return obj

});
