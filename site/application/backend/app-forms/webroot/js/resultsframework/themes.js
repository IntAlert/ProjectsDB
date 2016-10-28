
app.controller('ThemesController', function($scope, FormOptions, ResultsFrameworkService) {

	$scope.data = ResultsFrameworkService
	$scope.FormOptions = FormOptions

	// Bend over backwards to make md-radio-button select an object
	$scope.local = {
		pathways: {
			primaryId: null,
			secondaryId: null,
		}
	}

	// react to user input
	$scope.updatePathways = function() {

		$scope.FormOptions.pathways.map(function(p){
			if (p.Pathway.id == $scope.local.pathways.primaryId)
				$scope.data.record.pathways.primary = p;

			if (p.Pathway.id == $scope.local.pathways.secondaryId)
				$scope.data.record.pathways.secondary = p;
		})

	}

	// update primaryId and secondaryId ONCE
	$scope.$watch('data.record.pathways', function(){
		if($scope.data.record.pathways.primary)
			$scope.local.pathways.primaryId = $scope.data.record.pathways.primary.Pathway.id;
		if($scope.data.record.pathways.secondary)
			$scope.local.pathways.secondaryId = $scope.data.record.pathways.secondary.Pathway.id;
	})



})