app.controller('ResultsframeworkController', function ($scope, $window, $location, $anchorScroll, NonInteractiveDialogService, ResultsFrameworkService) {

	// UI
	$scope.disableTabsByValid = true;

	// debug
	// $scope.disableTabsByValid = false;
	$scope.selectedTabIndex = 2;

	
	$scope.changeActiveTab = function(i) {
		
		$scope.selectedTabIndex = i

		$location.hash('tabs');
		$anchorScroll();

	}

	$scope.save = function(data) {
		ResultsFrameworkService.save()
			.then(function(data){

			}, function(data){
				// fail
			})
	}

	// Load all data
	ResultsFrameworkService.load()

	
});

