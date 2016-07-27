
var app = angular
	.module('resultsframework', ['ngMaterial', 'ngMessages', "checklist-model"])
	.config(function($mdDateLocaleProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};
	})

// shared ResultsData
app.factory('ResultsData', function(){
  return {
  		themes: [],
  		grography: {
  			countries: [],
	  		regions: []
  		},
		researches: [{
			title: "Test Research Title",
			themes: [],
			countries: []
		}],
		results: []
	};
});


app.factory('FormOptions', function($http) {
  var formOptionsInstance = {
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



app.controller('ResultsframeworkController', function ($scope, $window, $location, $anchorScroll) {

	// UI
	$scope.disableTabsByValid = true;

	// debug
	// $scope.disableTabsByValid = false;
	$scope.selectedTabIndex = 7;

	
	$scope.changeActiveTab = function(i) {
		
		$scope.selectedTabIndex = i

		$location.hash('tabs');
		$anchorScroll();

	}
	
});

