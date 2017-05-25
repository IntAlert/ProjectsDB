
app.controller('OtherActivitiesController', function($scope, $mdDialog, DedupeService, OtherActivitiesService){

	$scope.data = OtherActivitiesService

	$scope.removeDialogueOtherActivityItem = function(id) {
		if (confirm("Are you sure you want to remove this activity?")) {
			OtherActivitiesService.delete(id)
		}
	}

	$scope.showDialogueOtherActivityItemDialog = function(i) {

		// add or edit
		var otherActivityToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: OtherActivityItemController,
	      templateUrl: '/forms/partials/resultsframework/other-activity-item.tmpl.html?' + Math.random(),
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: false,
	      locals: {
	      	data: otherActivityToEdit
	      }
	    }).then(function(otherActivity) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
	    		OtherActivitiesService.create(otherActivity)
	    	} else {
	    		// edit
	    		OtherActivitiesService.update(otherActivity)
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };

})

function OtherActivityItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;


	// options for form fields
	$scope.FormOptions = FormOptions;

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(dialogue) {
		$mdDialog.hide(dialogue);
	};

	// don't allow invalid date range
	$scope.$watch('data.OtherActivity.start_date', function(){
		if (!data.OtherActivity) return
		if (data.OtherActivity.start_date > data.OtherActivity.finish_date) {
			data.OtherActivity.finish_date = data.OtherActivity.start_date
		}
	})
	$scope.$watch('data.OtherActivity.finish_date', function(){
		if (!data.OtherActivity) return
		if (data.OtherActivity.finish_date < data.OtherActivity.start_date) {
			data.OtherActivity.start_date = data.OtherActivity.finish_date
		}
	})
}