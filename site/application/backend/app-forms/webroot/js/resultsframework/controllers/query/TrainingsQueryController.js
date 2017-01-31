
app.controller('TrainingsQueryController', function($window, $scope, $mdDialog, $window, DedupeService, ResultsFrameworkService, FormOptions, TrainingsService){

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
		departments: {
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
		  { name:'Project Id', field: 'Training.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Training Id', field: 'Training.id', visible:false },
		  { name:'Title', field: 'Training.title' },
		  { name:'Males', field: 'Training.male_count' },
		  { name:'Females', field: 'Training.female_count' },
		  { name:'Start Date', field: 'Training.start_date'},
		  { name:'Finish Date', field: 'Training.finish_date'},
		],
		
		enableGridMenu:true,
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

	$scope.downloadCSV = function() {
		var url = TrainingsService.api_urls.csv + '&download=1';
		$window.open(url, "_blank");
	}

	// Load with default query
	$scope.updateQuery()
	
})