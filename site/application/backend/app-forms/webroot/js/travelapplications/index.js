app.controller('TravelapplicationListController', function ($scope, $location, CountriesService, Office365UsersService, TravelapplicationsService, $httpParamSerializer) {


	$scope.travelapplications = []

	$scope.FormOptions = {
		countries: CountriesService,
		users: Office365UsersService
	}


	// determine query
	$scope.query = {
		country: $location.search().country | -1,
		// allDates: typeof($location.search().allDates) == 'undefined') | $location.search().allDates,
		// date: new Date(),
		applicant: $location.search().applicant | -1,
		contact: $location.search().contact | -1
	}

	if (typeof($location.search().allDates) == 'undefined') {
		$scope.query.allDates = true
	} else {
		$scope.query.allDates = $location.search().allDates
	}

	if (typeof($location.search().date) == 'undefined') {
		$scope.query.date = new Date()
	} else {
		$scope.query.date = new Date($location.search().date)
	}

	

	$scope.getTravelapplications = function() {

		var date_formatted = '2016-07-11';

		var q = {
			destination_territory_id: $scope.query.country,
	  		date: date_formatted,
	  		contact_o365_object_id: $scope.query.contact,
	  		applicant_o365_object_id: $scope.query.applicant
		}

		TravelapplicationsService
			.search(q)
			.then(function(response) {
				$scope.travelapplications = response
			})
	}

	$scope.submitForm = function() {
		var params = $httpParamSerializer($scope.query);
		window.location.href= window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params
	}

	$scope.getTravelapplications();


})