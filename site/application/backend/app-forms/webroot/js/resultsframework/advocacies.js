app.controller('AdvocaciesController', function($scope, $mdDialog, ResultsData, DedupeService){

	$scope.data = ResultsData

	$scope.removeAdvocacyItem = function(i) {
		if (confirm("Are you sure you want to remove this advocacy item?")) {
			$scope.data.advocacies.items.splice(i,1)
			updateTotals()
		}
	}

	$scope.showAdvocacyItemDialog = function(i) {

		// add or edit
		var advocacyToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.advocacies.items[i]

	    $mdDialog.show({
	      controller: AdvocacyItemController,
	      templateUrl: '/forms/partials/resultsframework/advocacy-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: {
		      	advocacy: advocacyToEdit	
	      	}
	      }
	    }).then(function(advocacy) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				$scope.data.advocacies.items.push(advocacy)
	    	} else {
	    		// edit
	    		$scope.data.advocacies.items[i] = advocacy	
	    	}
			updateTotals()

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

	  function updateTotals() {
	  		var totals = {
	  			male_count: 0,
	  			female_count: 0,
	  			participant_types: {}
	  		}

	  		var themes = []

			// loop through all items
			angular.forEach($scope.data.advocacies.items, function(item) {

				// fe/male counts
				totals.male_count += item.male_count
				totals.female_count += item.female_count

				// loop through all participant types
				angular.forEach(item.participant_types, function(count, participant_type) {

					if (count) {

						if ( !totals.participant_types.hasOwnProperty(participant_type) ) {
							totals.participant_types[participant_type] = 0
						}
					}

					totals.participant_types[participant_type] += count


				})

				themes = themes.concat(item.themes)

			});

			totals.themes = DedupeService.themes(themes)




			$scope.data.advocacies.totals = totals;
	  }
})

function AdvocacyItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions;

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(advocacy) {
		$mdDialog.hide(advocacy);
	};
}