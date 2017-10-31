app.controller('ResultsframeworkApproveController', function($window, $scope, $mdDialog, ResultsService){
	
	$scope.approvePublication = function(id){
		ResultsService.approvePublication(id);
	}

	$scope.blockPublication = function(id){
		ResultsService.blockPublication(id);
	}
	
})
