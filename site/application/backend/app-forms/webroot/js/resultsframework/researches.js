
app.controller('ResearchesController', function($scope, $mdDialog, ResultsData){

	$scope.data = ResultsData

	$scope.removeResearchItem = function(i) {
		if (confirm("Are you sure you want to remove this research item?")) {
			$scope.data.researches.splice(i,1)
		}
	}

	$scope.showResearchItemDialog = function(i) {

		// add or edit
		var researchToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.researches[i]

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
				$scope.data.researches.push(research)
	    	} else {
	    		// edit
	    		$scope.data.researches[i] = research	
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };
})

function ResearchItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(research) {
		$mdDialog.hide(research);
	};
}