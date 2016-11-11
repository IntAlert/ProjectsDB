
app.controller('DialoguesController', function($scope, $mdDialog, DedupeService, MeetingsService){

	$scope.data = MeetingsService

	$scope.removeDialogueProcessItem = function(id) {
		if (confirm("Are you sure you want to remove this dialogue process?")) {
			MeetingsService.delete(id)
			updateTotals()
		}
	}

	$scope.showDialogueProcessItemDialog = function(i) {

		// add or edit
		var dialogueToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.record.dialogues.processes.items[i]

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
	    		MeetingsService.create(process)
	    	} else {
	    		// edit
	    		MeetingsService.update(process)
	    	}
			

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

			var themes_process = []
			var themes_meeting = []
			var participant_types_process = []
			var participant_types_meeting = []

			// loop through all process items
			angular.forEach($scope.data.record.dialogues.processes.items, function(item) {

				totals.male_count += item.male_count
				totals.female_count += item.female_count
				totals.female_trauma_count += item.female_trauma_count
				totals.male_trauma_count += item.male_trauma_count
				totals.process_count++
				totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

				themes_process = themes_process.concat(item.themes)
	  			participant_types_process = participant_types_process.concat(item.participant_types)

			});



			// loop through all meeting items
			angular.forEach($scope.data.record.dialogues.meetings.items, function(item) {

				totals.male_count += item.male_count
				totals.female_count += item.female_count
				totals.female_trauma_count += item.female_trauma_count
				totals.male_trauma_count += item.male_trauma_count
				totals.meeting_count++
				totals.conflict_resolution = totals.conflict_resolution || item.conflict_resolution

				themes_meeting = themes_meeting.concat(item.themes)
	  			participant_types_meeting = participant_types_meeting.concat(item.participant_types)

			});

			totals.themes_process = DedupeService.themes(themes_process)
			totals.participant_types_process = DedupeService.participantTypes(participant_types_process)
			totals.themes_meeting = DedupeService.themes(themes_meeting)
			totals.participant_types_meeting = DedupeService.participantTypes(participant_types_meeting)

			$scope.data.record.dialogues.totals = totals;
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