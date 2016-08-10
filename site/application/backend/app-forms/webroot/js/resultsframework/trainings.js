
app.controller('TrainingsController', function($scope, $mdDialog, ResultsData, DedupeService){

	$scope.data = ResultsData

	$scope.removeTrainingItem = function(i) {
		if (confirm("Are you sure you want to remove this training item?")) {
			$scope.data.trainings.items.splice(i,1)
			updateTotals()
		}
	}

	$scope.showTrainingItemDialog = function(i) {

		// add or edit
		var trainingToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.trainings.items[i]

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
				$scope.data.trainings.items.push(training)
	    	} else {
	    		// edit
	    		$scope.data.trainings.items[i] = training	
	    	}
			
			updateTotals()

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };



	function updateTotals() {

		var totals = {
			'event_count': 0,
			'male_count': 0,
			'female_count': 0
		}

		var themes = []
		var participant_types = []

		angular.forEach($scope.data.trainings.items, function(item) {
			this.event_count++
  			this.male_count += item.male_count
  			this.female_count += item.female_count

  			themes = themes.concat(item.themes)
  			participant_types = participant_types.concat(item.participant_types)

		}, totals);

		totals.themes = DedupeService.themes(themes)
		totals.participant_types = DedupeService.participantTypes(participant_types)


		$scope.data.trainings.totals = totals;
	}
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