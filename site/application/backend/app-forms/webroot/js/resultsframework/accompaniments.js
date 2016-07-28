app.controller('AccompanimentsController', function($scope, $mdDialog, ResultsData){

	$scope.data = ResultsData

	$scope.removeAccompanimentItem = function(i) {
		if (confirm("Are you sure you want to remove this accompaniment item?")) {
			$scope.data.accompaniments.splice(i,1)
		}
	}

	$scope.showAccompanimentItemDialog = function(i) {

		// add or edit
		var accompanimentToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.accompaniments[i]

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
				$scope.data.accompaniments.push(accompaniment)
	    	} else {
	    		// edit
	    		$scope.data.accompaniments[i] = accompaniment	
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };
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