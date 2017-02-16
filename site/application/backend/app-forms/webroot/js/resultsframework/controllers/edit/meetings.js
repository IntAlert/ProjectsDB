
app.controller('MeetingsController', function($scope, $mdDialog, DedupeService, MeetingsService){

	$scope.data = MeetingsService

	$scope.removeDialogueMeetingItem = function(id) {
		if (confirm("Are you sure you want to remove this dialogue meeting?")) {
			MeetingsService.delete(id)
		}
	}

	$scope.showDialogueMeetingItemDialog = function(i) {

		// add or edit
		var meetingToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: DialogueItemController,
	      templateUrl: '/forms/partials/resultsframework/dialogue-meeting-item.tmpl.html?' + Math.random(),
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: false,
	      locals: {
	      	data: meetingToEdit
	      }
	    }).then(function(meeting) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
	    		MeetingsService.create(meeting)
	    	} else {
	    		// edit
	    		MeetingsService.update(meeting)
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

	// don't allow invalid date range
	$scope.$watch('data.Meeting.start_date', function(){
		if (!data.Meeting) return
		if (data.Meeting.start_date > data.Meeting.finish_date) {
			data.Meeting.finish_date = data.Meeting.start_date
		}
	})
	$scope.$watch('data.Meeting.finish_date', function(){
		if (!data.Meeting) return
		if (data.Meeting.finish_date < data.Meeting.start_date) {
			data.Meeting.start_date = data.Meeting.finish_date
		}
	})
}