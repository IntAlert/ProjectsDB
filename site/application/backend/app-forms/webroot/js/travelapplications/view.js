
var app = angular
	.module('travelapplication', ['ngMaterial', 'ngMessages'])
	.config(function($mdDateLocaleProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};
	})
	.config(['$locationProvider', function($locationProvider) {
        $locationProvider.html5Mode(false);
    }]);



app.controller('TravelapplicationViewController', function ($scope, $http, $location) {


	// all form fields
	$scope.formData = null;

	// determine application ID
	var parts = window.location.pathname.split('/')
	var TravelApplicationID = parts[parts.length - 1]

	// Load data

	// Get travelapplication JSON
	$http.get('/forms/travelapplications/viewJson/' + TravelApplicationID)
		.then(function(response){
			$scope.formData = response.data;
		}, function(){
			alert("Failed to find application")
		});

});

