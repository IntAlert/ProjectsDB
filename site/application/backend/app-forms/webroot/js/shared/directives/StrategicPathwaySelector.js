app.directive('strategicPathwaySelector',
	function() {
		return {
			require: '^ngModel',
			scope: {
				'ngModel': '=',
				'pathways': '='
			},
			controller: function($scope) {

				$scope.selectedPathwayId = null;

				$scope.updatePathway = function(){

					$scope.pathways.map(function(p){

						if (p.Pathway.id == $scope.selectedPathwayId)
							$scope.ngModel = p.Pathway;
					})

				};

				$scope.$watch('ngModel', function(){
					if($scope.ngModel) {
						$scope.selectedPathwayId = $scope.ngModel.id;
					}
					
				})


			},
            template: '<md-radio-group ng-model="selectedPathwayId" ng-change="updatePathway()">' +
					      '<md-radio-button ' +
					      '	ng-repeat="pathway in pathways"' +
					      '	ng-value="pathway.Pathway.id" ' +
					      '	class="md-primary">' +
					      '		{{pathway.Pathway.name}}' +
					      '</md-radio-button>' +
					    '</md-radio-group>'
        }
    }
);