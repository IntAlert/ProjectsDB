app.controller('AccompanimentsController', function($scope, $mdDialog, ResultsFrameworkService){

	$scope.data = ResultsFrameworkService

	$scope.removeAccompanimentItem = function(i) {
		if (confirm("Are you sure you want to remove this accompaniment item?")) {
			$scope.data.record.accompaniments.items.splice(i,1)
			updateTotals()
		}
	}

	$scope.showAccompanimentItemDialog = function(i) {

		// add or edit
		var accompanimentToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.record.accompaniments.items[i]

	    $mdDialog.show({
	      controller: AccompanimentItemController,
	      templateUrl: '/forms/partials/resultsframework/accompaniment-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: {
		      	accompaniment: accompanimentToEdit	
	      	}
	      }
	    }).then(function(accompaniment) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				$scope.data.record.accompaniments.items.push(accompaniment)
	    	} else {
	    		// edit
	    		$scope.data.record.accompaniments.items[i] = accompaniment	
	    	}

	    	updateTotals()
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

	function updateTotals() {

		var totals = {}

		// loop through all items
		angular.forEach($scope.data.record.accompaniments.items, function(item) {

			// loop through all participant types
			angular.forEach(item.participant_types, function(count, participant_type) {

				if (count) {

					if ( !totals.hasOwnProperty(participant_type) ) {
						totals[participant_type] = 0
					}
				}

				totals[participant_type] += count

			})

		});

		$scope.data.record.accompaniments.totals = totals;
	}
})

function AccompanimentItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions;

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(accompaniment) {
		$mdDialog.hide(accompaniment);
	};
}