app.controller('ResultsframeworkQueryController', function ($scope, $window, $location, $anchorScroll, NonInteractiveDialogService, ResultsFrameworkService) {

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

	$scope.save = function(data) {
		ResultsFrameworkService.save()
			.then(function(data){

			}, function(data){
				// fail
			})
	}

	// Load all data
	// NonInteractiveDialogService.show("Project Data", "Loading... Please wait for records to load.")
	// ResultsFrameworkService.load()
	// .then(function(){
	// 	NonInteractiveDialogService.hide()
	// })

	
});

