
app.controller('ResultsController', function($scope, $mdDialog, ResultsFrameworkService){

	$scope.data = ResultsFrameworkService

	$scope.removeResultItem = function(i) {
		if (confirm("Are you sure you want to remove this result?")) {
			$scope.data.record.results.items.splice(i,1)
		}
	}

	$scope.showResultItemDialog = function(i) {

		// add or edit
		var resultToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.record.results.items[i]

	    $mdDialog.show({
	      controller: ResultItemController,
	      templateUrl: '/forms/partials/resultsframework/result-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: {
		      	result: resultToEdit	
	      	}
	      }
	    }).then(function(result) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				$scope.data.record.results.items.push(result)
	    	} else {
	    		// edit
	    		$scope.data.record.results.items[i] = result	
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