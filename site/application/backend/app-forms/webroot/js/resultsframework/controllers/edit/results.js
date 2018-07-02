
app.controller('ResultsController', function($scope, $mdDialog, ResultsService){

	$scope.data = ResultsService

	$scope.removeResultItem = function(id) {
		if (confirm("Are you sure you want to remove this result?")) {
			ResultsService.delete(id)
		}
	}

	$scope.showResultItemDialog = function(i) {

		// add or edit
		var resultToEdit = (typeof(i) == 'undefined') ? {} : $scope.data.items[i]

	    $mdDialog.show({
	      controller: ResultItemController,
	      templateUrl: '/forms/partials/resultsframework/result-item.tmpl.html?' + Math.random(),
	      parent: angular.element(document.body),
	      // targetEvent: ev,
	      clickOutsideToClose: false,
	      locals: {
	      	data: resultToEdit
	      }
	    }).then(function(result) {
	    	// add or edit
	    	if (typeof(i) == 'undefined') {
	    		// add
				ResultsService.create(result)
	    	} else {
	    		// edit
	    		ResultsService.update(result)
	    	}
			

	    }, function() {
	      console.log('You cancelled the dialog.');
	    });
		};
		
	
	$scope.showMagicParagraphDialog = function(i) {

		var result = $scope.data.items[i];

		console.log(result);

		var resultInProse = "International Alert implemented/is implementing a project in ";
		
		// ADD COUNTRY
		var territory_names = result.Project.Territory.map(function(territory){
			return territory.name;
		});

		resultInProse += territory_names.join(', ');

		resultInProse += " called ";

		// ADD PROJECT NAME
		resultInProse += result.Project.title.trim();

		// ADD ‘WHERE AND WHEN’
		resultInProse += "in " + result.Result.where.trim() + " ";
		resultInProse += "on " + result.Result.date + " ";
		resultInProse += ', ';

		// ADD ‘WHO’ 
		resultInProse += result.Result.who + " ";

		// [ADD ‘WHAT’ ]
		resultInProse += result.Result.what.trim();

		resultInProse += '. This is significant because ';

		// ADD ‘SIGNIFICANCE’ 
		resultInProse += result.Result.significance.trim();
		
		resultInProse += '. ';

		// ADD ‘EVIDENCE’ 
		resultInProse += result.Result.evidence.trim();

		// ADD ‘PARTNER CONTRIBUTION’ 
		resultInProse += result.Result.contribution_partner.trim();

		// ADD ‘ALERT CONTRIBUTION’ 
		resultInProse += result.Result.contribution_alert.trim();

		resultInProse += '.'


		$mdDialog.show(
      $mdDialog.alert()
        .parent(angular.element(document.querySelector('#popupContainer')))
        .clickOutsideToClose(true)
        .title('Result in prose')
        .textContent(resultInProse)
        .ariaLabel('Result in prose')
        .ok('Got it!')
		);
	}	
})

function ResultItemController($scope, $mdDialog, data, FormOptions) {

	$scope.data = data;

	// options for form fields
	$scope.FormOptions = FormOptions

	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	$scope.save = function(result) {
		$mdDialog.hide(result);
	};
}