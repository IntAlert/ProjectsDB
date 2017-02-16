
app.controller('ResearchesController', function($scope, $mdDialog, ResultsFrameworkService, ResearchesService){

	$scope.data = ResearchesService

	$scope.removeResearchItem = function(id) {
		if (confirm("Are you sure you want to remove this research item?")) {
			ResearchesService.delete(id)
		}
	}

	$scope.showResearchItemDialog = function(i) {

		// add or edit
		var researchToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: ResearchItemController,
	      templateUrl: '/forms/partials/resultsframework/research-item.tmpl.html?' + Math.random(),
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: false,
	      locals: {
	      	data: researchToEdit
	      }
	    }).then(function(research) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
	    		ResearchesService.create(research)
	    	} else {
	    		// edit
	    		ResearchesService.update(research)
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

		
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