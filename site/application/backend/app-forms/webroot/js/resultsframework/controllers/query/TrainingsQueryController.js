
app.controller('TrainingsQueryController', function($scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, TrainingsService){

	$scope.data = TrainingsService
	$scope.FormOptions = FormOptions


	// State
	$scope.state = {
		data_loading: true
	}

	// User Query
	$scope.query = {
		dates: {
			all: false,
			start: new Date(new Date().getFullYear(), 0, 1), // first day of year
			finish: new Date(new Date().getFullYear(), 11, 31) // last day of year
		},
		participant_types: {
			all: true,
			selected: null
		},
		themes: {
			all: true,
			selected: null
		},
		territories: {
			all: true,
			selected: null
		},
		pathways: {
			all: true,
			selected: null
		}
	}

	// Grid Options
	$scope.gridOptions = {
		enableSorting: true,
		columnDefs: [
		  { name:'Project ID', field: 'Training.project_id' },
		  { name:'title', field: 'Training.title' },
		  { name:'Males', field: 'Training.male_count' },
		  { name:'Females', field: 'Training.female_count' },
		  { name:'date', field: 'Training.date'}
		],
		
		enableGridMenu:true,
		exporterCsvFilename: 'test.csv',
		exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		TrainingsService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = TrainingsService.items
				$scope.state.data_loading = false
			})
	}

	// Load with default query
	$scope.updateQuery()
	
})