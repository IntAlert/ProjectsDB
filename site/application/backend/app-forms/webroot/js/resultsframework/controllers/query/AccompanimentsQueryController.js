
app.controller('AccompanimentsQueryController', function($window, $scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, AccompanimentsService){

	$scope.data = AccompanimentsService
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
		  { name:'Project Id', field: 'Accompaniment.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Accompaniment Id', field: 'Accompaniment.id', visible:false },
		  { name:'Title', field: 'Accompaniment.title' },
		  { name:'Start Date', field: 'Accompaniment.start_date'},
		  { name:'Finish Date', field: 'Accompaniment.finish_date'},
		],
		
		enableGridMenu:true,
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		AccompanimentsService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = AccompanimentsService.items
				$scope.state.data_loading = false
			})
	}

	$scope.downloadCSV = function() {
		var url = AccompanimentsService.api_urls.csv + '&download=1';
		$window.open(url);
	}

	// Load with default query
	$scope.updateQuery()
	
})