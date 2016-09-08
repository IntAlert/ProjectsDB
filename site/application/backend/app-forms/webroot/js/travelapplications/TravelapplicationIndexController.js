app.controller('TravelapplicationIndexController', function ($scope, $location, CountriesService, Office365UsersService, TravelapplicationsService, $mdDialog, NonInteractiveDialogService) {


	$scope.searching = true;
	$scope.me = me;

	$scope.travelapplications = [];

	$scope.FormOptions = {
		countries: CountriesService,
		users: Office365UsersService
	}

	$scope.query = {
		mode: 'mine',
		country: -1,
		allDates: true,
		date: new Date(),
		applicant_o365_object_id: -1
	}

	// previewed form is held here:
	$scope.formData = null;

	$scope.previewTravelapplication = function(ev, ta){
		$scope.formData = ta;

		$mdDialog.show({
	      controller: function($scope, $mdDialog) {},
	      contentElement: '#myDialog',
	      parent: angular.element(document.body),
	      targetEvent: ev,
	      clickOutsideToClose:true,
	      fullscreen: false
	    })
	}

	$scope.getMyTravelapplications = function() {

		NonInteractiveDialogService.show('Searching', 'Searching all travel applications', null);
		$scope.travelapplications = [];

		TravelapplicationsService.getMyTravelapplications()
			.then(function(response) {
				$scope.travelapplications = response;
				NonInteractiveDialogService.hide();
			})
	}

	$scope.getManagedTravelapplications = function() {

		NonInteractiveDialogService.show('Searching', 'Searching all travel applications', null);
		$scope.travelapplications = [];

		var query = {
			applicant_o365_object_id: $scope.query.applicant_o365_object_id
		}

		if ( $scope.query.allDates ) {
			query.date = -1;
		} else {
			// get yyyy-mm-dd format
			var date_formatted = $scope.query.date.toISOString().substring(0, 10);
			query.date = date_formatted;
		}

		TravelapplicationsService.getManagedTravelapplications(query)
			.then(function(response) {
				$scope.travelapplications = response;
				NonInteractiveDialogService.hide();
			})
	}

	$scope.getTravelapplications = function() {

		NonInteractiveDialogService.show('Searching', 'Searching all travel applications', null);
		$scope.travelapplications = [];

		var query = {
			destination_territory_id: $scope.query.country,
	  		contact_o365_object_id: $scope.query.contact,
	  		applicant_o365_object_id: $scope.query.applicant_o365_object_id
		}

		if ( $scope.query.allDates ) {
			query.date = -1;
		} else {
			// get yyyy-mm-dd format
			var date_formatted = $scope.query.date.toISOString().substring(0, 10);
			query.date = date_formatted;
		}

		$scope.searching = true;
		TravelapplicationsService
			.search(query)
			.then(function(response) {
				$scope.travelapplications = response;
				NonInteractiveDialogService.hide();
				$scope.searching = false;
			})
	}


	// get all travel applications
	NonInteractiveDialogService.show('Loading', 'Loading most recent travel applications', null);
	TravelapplicationsService
			.getMyTravelapplications()
			.then(function(response) {
				$scope.travelapplications = response
				NonInteractiveDialogService.hide()
				$scope.searching = false;
			})


})