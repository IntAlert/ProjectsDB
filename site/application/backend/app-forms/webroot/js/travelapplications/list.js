app.controller('TravelapplicationListController', function ($scope, $location, CountriesService, Office365UsersService, TravelapplicationsService, $httpParamSerializer, $mdDialog) {


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


	// previewed form is held here:
	$scope.formData = null;

	$scope.previewTravelapplication = function(ev, ta){
		$scope.formData = ta;

		$mdDialog.show({
	      controller: function($scope, $mdDialog) {
		    // $scope.hide = function() {
		    //   $mdDialog.hide();
		    // };

		    // $scope.cancel = function() {
		    //   $mdDialog.cancel();
		    // };
		  },
	      contentElement: '#myDialog',
	      parent: angular.element(document.body),
	      targetEvent: ev,
	      clickOutsideToClose:true,
	      fullscreen: false
	    })
	    .then(function(answer) {
	      $scope.status = 'You said the information was "' + answer + '".';
	    }, function() {
	      $scope.status = 'You cancelled the dialog.';
	    });
	}

	$scope.getTravelapplications = function() {

		$scope.searching = true;
		$scope.travelapplications = [];

		var query = {
			destination_territory_id: $scope.query.country,
	  		contact_o365_object_id: $scope.query.contact,
	  		applicant_o365_object_id: $scope.query.applicant
		}

		if ( $scope.query.allDates ) {
			query.date = -1;
		} else {
			// get yyyy-mm-dd format
			var date_formatted = $scope.query.date.toISOString().substring(0, 10);
			query.date = date_formatted;
		}

		TravelapplicationsService
			.search(query)
			.then(function(response) {
				$scope.travelapplications = response
				$scope.searching = false;
			})
	}


	// get all travel applications
	$scope.searching = true;
	TravelapplicationsService
			.getAll()
			.then(function(response) {
				$scope.travelapplications = response
				$scope.searching = false;
			})


})