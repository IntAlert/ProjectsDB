app.factory('FormOptions', function($http) {
  var formOptionsInstance = {
	participant_types: [],
	impacts: [],
  	// results: {
  	// 	impacts: [
  	// 		{"name": "Changed knowledge and attitudes"},
  	// 		{"name": "Changed behaviours and processes"},
  	// 		{"name": "Changed conditions"}
  	// 	]
  	// }
  };


  // All countries
	$http.get('/api/territories/allCountries')
		.then(function(response){
			formOptionsInstance.countries = response.data;
		}, function(){
			alert("countries download error")
		});

	// All regions
	$http.get('/api/territories/allRegions')
		.then(function(response){
			formOptionsInstance.regions = response.data;
		}, function(){
			alert("regions download error")
		});

	// All themes
	$http.get('/api/themes/all')
		.then(function(response){
			formOptionsInstance.themes = response.data;
		}, function(){
			alert("themes download error")
		});

	// All pathways
	$http.get('/api/pathways/all')
		.then(function(response){
			formOptionsInstance.pathways = response.data;
		}, function(){
			alert("pathways download error")
		});


	// All participant types
	$http.get('/api/participant_types/all')
		.then(function(response){
			formOptionsInstance.participant_types = response.data.data;
		}, function(){
			alert("participant_types download error")
		});

	// All participant types
	$http.get('/api/impacts/all')
		.then(function(response){
			formOptionsInstance.impacts = response.data.data;
		}, function(){
			alert("participant_types download error")
		});

	$http.get('/api/departments/all')
		.then(function(response){
			formOptionsInstance.departments = response.data.data;
			console.log(formOptionsInstance.departments)
		}, function(){
			alert("departments download error")
		});
  

  return formOptionsInstance;
});