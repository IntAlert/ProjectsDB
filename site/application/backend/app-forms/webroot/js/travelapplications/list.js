app.controller('TravelapplicationListController', function ($scope, $location, CountriesService, Office365UsersService, TravelapplicationsService, $httpParamSerializer) {


	$scope.travelapplications = []

	$scope.FormOptions = {
		countries: CountriesService,
		users: Office365UsersService
	}

	$scope.query = {
		country: $location.search().country | -1,
		allDates: true,
		date: new Date(),
		applicant: $location.search().applicant | -1,
		contact: $location.search().contact | -1
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
				console.log(response)
			})
	}


})