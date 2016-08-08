
app.controller('DialoguesController', function($scope, $mdDialog, ResultsData){

	$scope.data = ResultsData

	$scope.removeDialogueProcessItem = function(i) {
		if (confirm("Are you sure you want to remove this dialogue item?")) {
			$scope.data.dialogues.processes.items.splice(i,1)
			updateTotals()
		}
	}

	$scope.showDialogueProcessItemDialog = function(i) {

		// add or edit
		var dialogueToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.dialogues.processes.items[i]

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
				$scope.data.dialogues.processes.items.push(dialogue)
	    	} else {
	    		// edit
	    		$scope.data.dialogues.processes.items[i] = dialogue	
	    	}

	    	updateTotals()
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
	  };



	  // Meetings
		$scope.removeDialogueMeetingItem = function(i) {
			if (confirm("Are you sure you want to remove this dialogue item?")) {
				$scope.data.dialogues.meetings.items.splice(i,1)
				updateTotals()
			}
		}

		$scope.showDialogueMeetingItemDialog = function(i) {

			// add or edit
			var dialogueToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.dialogues.meetings.items[i]

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
					$scope.data.dialogues.meetings.items.push(dialogue)
		    	} else {
		    		// edit
		    		$scope.data.dialogues.meetings.items[i] = dialogue	
		    	}

		    	updateTotals()
				

		    }, function() {
		      console.log('You cancelled the dialog.');
		    });
		  };


		function updateTotals() {

			var totals = {
				male_count: 0,
				female_count: 0,
				process_count: 0,
				meeting_count: 0,
				male_trauma_count: 0,
				female_trauma_count: 0,
				conflict_resolution: false
			}

			// loop through all process items
			angular.forEach($scope.data.dialogues.processes.items, function(item) {

				totals.male_count += item.male_count
				totals.female_count += item.female_count
				totals.female_trauma_count += item.female_trauma_count
				totals.male_trauma_count += item.male_trauma_count
				totals.process_count++
				totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

			});

			// loop through all meeting items
			angular.forEach($scope.data.dialogues.meetings.items, function(item) {

				totals.male_count += item.male_count
				totals.female_count += item.female_count
				totals.female_trauma_count += item.female_trauma_count
				totals.male_trauma_count += item.male_trauma_count
				totals.meeting_count++
				totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

			});

			$scope.data.dialogues.totals = totals;
		}
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