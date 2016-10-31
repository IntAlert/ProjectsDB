app.directive('dateStringSelector',
	function() {
		return {
			require: '^ngModel',
			scope: {
				'ngModel': '=',
				'mdPlaceholder': '@'
			},
			controller: function($scope) {

				$scope.$watch('ngModel', function(){
					if(typeof($scope.ngModel) == 'string') {
						// convert to a date object
						$scope.ngModel = new Date($scope.ngModel)
					}
				})


			},
            template: 
        		'<md-datepicker ' +
					'required ' +
					'ng-model="ngModel"  ' +
					'md-placeholder="md-placeholder"> ' +
				'</md-datepicker>'
        }
    }
);