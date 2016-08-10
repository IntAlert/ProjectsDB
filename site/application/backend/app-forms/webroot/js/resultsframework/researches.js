
app.controller('ResearchesController', function($scope, $mdDialog, ResultsData, DedupeService){

	$scope.data = ResultsData

	$scope.removeResearchItem = function(i) {
		if (confirm("Are you sure you want to remove this research item?")) {
			$scope.data.researches.items.splice(i,1)
			updateTotals()
		}
	}

	$scope.showResearchItemDialog = function(i) {

		// add or edit
		var researchToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.researches.items[i]

	    $mdDialog.show({
	      controller: ResearchItemController,
	      templateUrl: '/forms/partials/resultsframework/research-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: {
		      	research: researchToEdit	
	      	}
	      }
	    }).then(function(research) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				$scope.data.researches.items.push(research)
	    	} else {
	    		// edit
	    		$scope.data.researches.items[i] = research	
	    	}

	    	updateTotals()
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

		function updateTotals() {

			var totals = {
				count: $scope.data.researches.items.length
			};

			var themes = []
			var countries = []

			angular.forEach($scope.data.researches.items, function(item) {

				totals.male_count += item.male_count
				totals.female_count += item.female_count
				totals.female_trauma_count += item.female_trauma_count
				totals.male_trauma_count += item.male_trauma_count
				totals.meeting_count++
				totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

				themes = themes.concat(item.themes)
	  			countries = countries.concat(item.countries)

			});

			totals.themes = DedupeService.themes(themes)
			totals.countries = DedupeService.territories(countries)

			$scope.data.researches.totals = totals

		}
})

function ResearchItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(research) {
		$mdDialog.hide(research);
	};
}