app.controller('AdvocaciesController', function($scope, $mdDialog, DedupeService, ResultsFrameworkService, AdvocaciesService){

	$scope.data = AdvocaciesService

	$scope.removeAdvocacyItem = function(id) {
		if (confirm("Are you sure you want to remove this advocacy item?")) {
			AdvocaciesService.delete(id)
		}
	}

	$scope.showAdvocacyItemDialog = function(i) {

		// add or edit
		var advocacyToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: AdvocacyItemController,
	      templateUrl: '/forms/partials/resultsframework/advocacy-item.tmpl.html',
	      parent: angular.element(document.body),
	      clickOutsideToClose: false,
	      locals: {
	      	data: advocacyToEdit
	      }
	    }).then(function(advocacy) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				AdvocaciesService.create(advocacy)
	    	} else {
	    		// edit
	    		AdvocaciesService.update(advocacy)
	    	}

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };


	  $scope.cutOutZero = function() {
		return function( item ) {
			return item.AdvocaciesParticipantType.count != '0';
		};
	  };

	  
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