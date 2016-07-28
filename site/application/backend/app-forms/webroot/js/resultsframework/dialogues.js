
app.controller('DialoguesController', function($scope, $mdDialog, ResultsData){

	$scope.data = ResultsData

	$scope.removeDialogueProcessItem = function(i) {
		if (confirm("Are you sure you want to remove this dialogue item?")) {
			$scope.data.dialogues.processes.splice(i,1)
		}
	}

	$scope.showDialogueProcessItemDialog = function(i) {

		// add or edit
		var dialogueToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.dialogues.processes[i]

	    $mdDialog.show({
	      controller: DialogueItemController,
	      templateUrl: '/forms/partials/resultsframework/dialogue-process-item.tmpl.html',
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: true,
	      locals: {
	      	data: {
		      	dialogue: dialogueToEdit	
	      	}
	      }
	    }).then(function(dialogue) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				$scope.data.dialogues.processes.push(dialogue)
	    	} else {
	    		// edit
	    		$scope.data.dialogues.processes[i] = dialogue	
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };



	  // Meetings
		$scope.removeDialogueMeetingItem = function(i) {
			if (confirm("Are you sure you want to remove this dialogue item?")) {
				$scope.data.dialogues.meetings.splice(i,1)
			}
		}

		$scope.showDialogueMeetingItemDialog = function(i) {

			// add or edit
			var dialogueToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.dialogues.meetings[i]

		    $mdDialog.show({
		      controller: DialogueItemController,
		      templateUrl: '/forms/partials/resultsframework/dialogue-meeting-item.tmpl.html',
		      parent: angular.element(document.body),
		      // targetEvent: ev,
		      clickOutsideToClose: true,
		      locals: {
		      	data: {
			      	dialogue: dialogueToEdit	
		      	}
		      }
		    }).then(function(dialogue) {
		    	// add or edit
		    	if (typeof(i) == 'undefined') {
		    		// add
					$scope.data.dialogues.meetings.push(dialogue)
		    	} else {
		    		// edit
		    		$scope.data.dialogues.meetings[i] = dialogue	
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