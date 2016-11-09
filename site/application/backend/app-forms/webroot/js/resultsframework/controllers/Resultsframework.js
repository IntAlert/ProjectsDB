app.controller('ResultsframeworkController', function ($scope, $window, $location, $anchorScroll, NonInteractiveDialogService, ResultsFrameworkService) {

	// UI
	$scope.disableTabsByValid = true;

	// debug
	// $scope.disableTabsByValid = false;
	// $scope.selectedTabIndex = 1;

	
	$scope.changeActiveTab = function(i) {
		
		$scope.selectedTabIndex = i

		$location.hash('tabs');
		$anchorScroll();

	}


	NonInteractiveDialogService.show('Loading', 'Loading results for this project');

	// get any data that exists
	var path = $location.url()
	var parts = path.split('/')
	if (parts[4]) {
		var projectId = parts[4];
		ResultsFrameworkService.load(projectId)
			.then(NonInteractiveDialogService.hide)
	} else {
		// this should not happen
		alert('Error determining project id from path: ' + path)
	}
	

	$scope.save = function(data) {
		ResultsFrameworkService.save()
			.then(function(data){

			}, function(data){
				// fail
			})
	}

	
});

