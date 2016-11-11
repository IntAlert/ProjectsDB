
app.controller('ResultsController', function($scope, $mdDialog, ResultsService){

	$scope.data = ResultsService

	$scope.removeResultItem = function(id) {
		if (confirm("Are you sure you want to remove this result?")) {
			ResultsService.delete(id)
		}
	}

	$scope.showResultItemDialog = function(i) {

		// add or edit
		var resultToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: ResultItemController,
	      templateUrl: '/forms/partials/resultsframework/result-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: resultToEdit
	      }
	    }).then(function(result) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				ResultsService.create(result)
	    	} else {
	    		// edit
	    		ResultsService.update(result)
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };
})

function ResultItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(result) {
		$mdDialog.hide(result);
	};
}