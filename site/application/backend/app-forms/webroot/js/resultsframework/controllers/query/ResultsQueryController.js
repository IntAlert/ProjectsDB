app.controller('ResultsQueryController', function($window, $scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, ResultsService){

	$scope.data = ResultsService
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
		impacts: {
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
		  { name:'Project Id', field: 'Result.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Result Id', field: 'Result.id', visible:false },
		  { name:'Title', field: 'Result.title' },
		  { name:'Date', field: 'Result.date'},
		],
		
		enableGridMenu:true,
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		ResultsService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = ResultsService.items
				$scope.state.data_loading = false
			})
	}

	$scope.downloadCSV = function() {
		var url = ResultsService.api_urls.csv + '&download=1';
		$window.open(url, "_blank");
	}

	// Load with default query
	$scope.updateQuery()
	
})