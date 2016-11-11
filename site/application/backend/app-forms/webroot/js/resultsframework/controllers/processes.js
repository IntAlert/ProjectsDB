
app.controller('ProcessesController', function($scope, $mdDialog, DedupeService, ProcessesService){

	$scope.data = ProcessesService

	$scope.removeDialogueProcessItem = function(id) {
		if (confirm("Are you sure you want to remove this dialogue process?")) {
			ProcessesService.delete(id)
		}
	}

	$scope.showDialogueProcessItemDialog = function(i) {

		// add or edit
		var processToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: DialogueItemController,
	      templateUrl: '/forms/partials/resultsframework/dialogue-process-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: processToEdit
	      }
	    }).then(function(process) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
	    		ProcessesService.create(process)
	    	} else {
	    		// edit
	    		ProcessesService.update(process)
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

})

function DialogueItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions;

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(dialogue) {
		$mdDialog.hide(dialogue);
	};
}