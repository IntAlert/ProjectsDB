app.controller('TravelapplicationViewController', function ($scope, $http, $location, travelapplicationService) {


	// all form fields
	$scope.formData = null;

	// determine application ID
	var parts = window.location.pathname.split('/')
	var TravelApplicationID = parts[parts.length - 1]

	// Load data

	// Get travelapplication JSON
	travelapplicationService.getById(TravelApplicationID)
		.then(function(data){
			$scope.formData = data;
		}, function(){
			alert("Failed to find application")
		});

});

