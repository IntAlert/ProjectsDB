app.controller('AdvocaciesQueryController', function($window, $scope, $mdDialog, ResultsFrameworkService, FormOptions, AdvocaciesService){

	$scope.data = AdvocaciesService
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
		  { name:'Project Id', field: 'Advocacy.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Advocacy Id', field: 'Advocacy.id', visible:false },
		  { name:'Title', field: 'Advocacy.title' },
		  { name:'Start Date', field: 'Advocacy.start_date'},
		  { name:'Finish Date', field: 'Advocacy.finish_date'},
		],
		
		enableGridMenu:true,
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		AdvocaciesService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = AdvocaciesService.items
				$scope.state.data_loading = false
			})
	}

	$scope.downloadCSV = function() {
		var url = AdvocaciesService.api_urls.csv + '&download=1';
		$window.open(url);
	}

	// Load with default query
	$scope.updateQuery()
	
})