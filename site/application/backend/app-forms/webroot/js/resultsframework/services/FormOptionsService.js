app.factory('FormOptions', function($http) {
  var formOptionsInstance = {
	participant_types: [
		{name:"Youth groups"},
		{name:"Women's groups"},
		{name:"Local community groups"},
		{name:"Diaspora communities"},
		{name:"Refugee/ displaced communities"},
		{name:"Local NGO"},
		{name:"INGO"},
		{name:"IGO"},
		{name:"National Business"},
		{name:"Int'l Business"},
		{name:"Donors"},
		{name:"National Govt"},
		{name:"Sub-National Govt"},
		{name:"MPs/political parties"},
		{name:"Non-state armed groups"},
		{name:"Media"},
		{name:"Academic Institutions"},
		{name:"Think Tanks"}
	],
  	results: {
  		impacts: [
  			{"name": "Changed knowledge and attitudes"},
  			{"name": "Changed behaviours and processes"},
  			{"name": "Changed conditions"}
  		]
  	}
  };


  // All countries
	$http.get('/api/territories/allCountries.json')
		.then(function(response){
			formOptionsInstance.countries = response.data;
		}, function(){
			alert("countries download error")
		});

	// All regions
	$http.get('/api/territories/allRegions.json')
		.then(function(response){
			formOptionsInstance.regions = response.data;
		}, function(){
			alert("regions download error")
		});

	// All themes
	$http.get('/api/themes/all.json')
		.then(function(response){
			formOptionsInstance.themes = response.data;
		}, function(){
			alert("themes download error")
		});

	// All pathways
	$http.get('/api/pathways/all.json')
		.then(function(response){
			formOptionsInstance.pathways = response.data;
		}, function(){
			alert("pathways download error")
		});
  

  return formOptionsInstance;
});