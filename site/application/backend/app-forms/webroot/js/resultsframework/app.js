
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
  		dialogues: {
  			meetings: {
  				items: []
  			},
  			processes: {
  				items: []
  			}
  		},
  		grography: {
  			countries: [],
	  		regions: []
  		},
  		trainings: {
  			items: [],
  			totals: {}
  		},
		accompaniments: {
  			items: [],
  			totals: {}
  		},
		advocacies:{
  			items: [],
  			totals: {}
  		},
		researches: {
			items: [],
  			totals: {}
		},
		results: []
	};
});


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

  console.log(formOptionsInstance);


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

