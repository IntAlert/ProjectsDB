app.controller('DialogueProcessesQueryController', function($scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, ProcessesService){

	$scope.data = ProcessesService
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
		  { name:'Project Id', field: 'Process.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Process Id', field: 'Process.id', visible:false },
		  { name:'Title', field: 'Process.title' },
		  { name:'Males', field: 'Process.male_count' },
		  { name:'Females', field: 'Process.female_count' },
		  { name:'Start Date', field: 'Process.start_date'},
		  { name:'Finish Date', field: 'Process.finish_date'},
		],
		
		enableGridMenu:true,
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		ProcessesService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = ProcessesService.items
				$scope.state.data_loading = false
			})
	}

	$scope.downloadCSV = function() {
		var url = ProcessesService.api_urls.csv + '&download=1';
		$window.open(url, "_blank");
	}

	// Load with default query
	$scope.updateQuery()
	
})