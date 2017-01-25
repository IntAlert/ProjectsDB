app.directive('dateStringSelector',
	function() {
		return {
			require: '^ngModel',
			scope: {
				'ngModel': '=',
				'label': '@label',
				'min': '=',
				'max': '='
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
            		'<label>{{label}}</label>' +
	        		'<md-datepicker ' +
	        			'class="md-block"' +
						'required ' +
						'ng-model="localDate"  ' +
						'ng-change="updateDate()"' +
						'md-min-date="min"  ' +
						'md-max-date="max"  ' +
						'md-placeholder="Enter date"> ' +
					'</md-datepicker>' +
				'</div>'
        }
    }
);