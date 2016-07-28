
app.controller('TrainingsController', function($scope, $mdDialog, ResultsData){

	$scope.data = ResultsData

	$scope.removeTrainingItem = function(i) {
		if (confirm("Are you sure you want to remove this training item?")) {
			$scope.data.trainings.splice(i,1)
		}
	}

	$scope.showTrainingItemDialog = function(i) {

		// add or edit
		var trainingToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.trainings[i]

	    $mdDialog.show({
	      controller: TrainingItemController,
	      templateUrl: '/forms/partials/resultsframework/training-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: {
		      	training: trainingToEdit	
	      	}
	      }
	    }).then(function(training) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				$scope.data.trainings.push(training)
	    	} else {
	    		// edit
	    		$scope.data.trainings[i] = training	
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };
})

function TrainingItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions;

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(training) {
		$mdDialog.hide(training);
	};
}