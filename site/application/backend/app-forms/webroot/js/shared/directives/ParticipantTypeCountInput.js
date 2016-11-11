app.directive('ParticipantTypeCountInput',
	function() {
		return {
			require: '^ngModel',
			scope: {
				'ngModel': '=',
				'participantType': '@'
			},
			controller: function($scope) {

				$scope.count = 0;

				$scope.updatePathway = function(){

					$scope.pathways.map(function(p){

						if (p.Pathway.id == $scope.selectedPathwayId)
							$scope.ngModel = p.Pathway;
					})

				};

				$scope.$watch('ngModel', function(){
					if($scope.ngModel) {
						$scope.count = $scope.ngModel.id;
					}
					
				})


			},
            template: '<md-input-container class="md-block">' +
						'<label>Number of {{participant_type.ParticipantType.name}}</label>' +
						'<input ' +
						'	type="number"' +
						'	min="0"' +
						'	ng-model="data.ParticipantType[participant_type.ParticipantType.id]"' +
						'	>' +
				'</md-input-container>'

        }
    }
);