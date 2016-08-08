
app.controller('ResearchesController', function($scope, $mdDialog, ResultsData){

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

			$scope.data.researches.totals = {
				count: $scope.data.researches.items.length
			};
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