app.controller('AccompanimentsController', function($scope, $mdDialog, FormOptions, ResultsFrameworkService, AccompanimentsService){

	$scope.data = AccompanimentsService
	$scope.FormOptions = FormOptions	

	$scope.removeAccompanimentItem = function(id) {
		if (confirm("Are you sure you want to remove this accompaniment item?")) {
			AccompanimentsService.delete(id)
		}
	}

	$scope.showAccompanimentItemDialog = function(i) {

		// add or edit
		var accompanimentToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: AccompanimentItemController,
	      templateUrl: '/forms/partials/resultsframework/accompaniment-item.tmpl.html?' + Math.random(),
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: false,
	      locals: {
	      	data: accompanimentToEdit
	      }
	    }).then(function(accompaniment) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				AccompanimentsService.create(accompaniment)
	    	} else {
	    		// edit
	    		AccompanimentsService.update(accompaniment)
	    	}			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

	  $scope.cutOutZero = function() {
		return function( item ) {
			return item.AccompanimentsParticipantType.count != '0';
		};
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

	// don't allow invalid date range
	$scope.$watch('data.Accompaniment.start_date', function(){
		if (!data.Accompaniment) return
		if (data.Accompaniment.start_date > data.Accompaniment.finish_date) {
			data.Accompaniment.finish_date = data.Accompaniment.start_date
		}
	})
	$scope.$watch('data.Accompaniment.finish_date', function(){
		if (!data.Accompaniment) return
		if (data.Accompaniment.finish_date < data.Accompaniment.start_date) {
			data.Accompaniment.start_date = data.Accompaniment.finish_date
		}
	})
}