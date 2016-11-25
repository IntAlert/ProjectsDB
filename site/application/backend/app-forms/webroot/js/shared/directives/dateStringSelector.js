app.directive('dateStringSelector',
	function() {
		return {
			require: '^ngModel',
			scope: {
				'ngModel': '='
			},
			controller: function($scope) {

				$scope.localDate = null;

				// turn a saved string into a date object on load from DB
				$scope.$watch('ngModel', function(){
					if(typeof($scope.ngModel) == 'string') {
						// convert to a date object
						$scope.localDate = new Date($scope.ngModel)
					}
				})


				$scope.updateDate = function() {
					// correct for annoying timezone issue
					$scope.ngModel = $scope.localDate.addMinutes(-new Date().getTimezoneOffset())
				}


			},
            template: 
            	'<div class="date-string-selector-container">' +
	        		'<md-datepicker ' +
	        			'class="md-block"' +
						'required ' +
						'ng-model="localDate"  ' +
						'ng-change="updateDate()"' +
						'md-placeholder="Enter date"> ' +
					'</md-datepicker>' +
				'</div>'
        }
    }
);