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
					$scope.ngModel = $scope.localDate.addMinutes(-new Date().getTimezoneOffset())
				}


			},
            template: 
        		'<md-datepicker ' +
					'required ' +
					'ng-model="localDate"  ' +
					'ng-change="updateDate()"' +
					'md-placeholder="Enter date"> ' +
				'</md-datepicker>'
        }
    }
);