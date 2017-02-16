
app.controller('TrainingsController', function($scope, $mdDialog, DedupeService, ResultsFrameworkService, TrainingsService){

	$scope.data = TrainingsService

	$scope.removeTrainingItem = function(id) {
		if (confirm("Are you sure you want to remove this training item?")) {
			TrainingsService.delete(id)
		}
	}

	$scope.showTrainingItemDialog = function(i) {

		// add or edit
		var trainingToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: TrainingItemController,
	      templateUrl: '/forms/partials/resultsframework/training-item.tmpl.html?' + Math.random(),
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: false,
	      locals: {
	      	data: trainingToEdit
	      }
	    }).then(function(training) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
	    		TrainingsService.create(training)
	    	} else {
	    		// edit
	    		TrainingsService.update(training)
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

	// don't allow invalid date range
	$scope.$watch('data.Training.start_date', function(){
		if (!data.Training) return
		if (data.Training.start_date > data.Training.finish_date) {
			data.Training.finish_date = data.Training.start_date
		}
	})
	$scope.$watch('data.Training.finish_date', function(){
		if (!data.Training) return
		if (data.Training.finish_date < data.Training.start_date) {
			data.Training.start_date = data.Training.finish_date
		}
	})
}

