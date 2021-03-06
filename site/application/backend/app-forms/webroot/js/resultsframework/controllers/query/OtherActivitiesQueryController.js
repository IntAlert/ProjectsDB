app.controller('OtherActivitiesQueryController', function($window, $scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, OtherActivitiesService){

	$scope.data = OtherActivitiesService
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
		  { name:'Project Id', field: 'OtherActivity.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'OtherActivity Id', field: 'OtherActivity.id', visible:false },
		  { name:'Title', field: 'OtherActivity.title' },
		  { name:'Type', field: 'OtherActivity.type' },
		  { name:'Males', field: 'OtherActivity.male_count' },
		  { name:'Females', field: 'OtherActivity.female_count' },
		  { name:'Transgender', field: 'OtherActivity.transgender_count' },
		  { name:'Start Date', field: 'OtherActivity.start_date'},
		  { name:'Finish Date', field: 'OtherActivity.finish_date'},
		],
		
		enableGridMenu:true,
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		OtherActivitiesService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = OtherActivitiesService.items
				$scope.state.data_loading = false
			})
	}

	$scope.downloadCSV = function() {
		var url = OtherActivitiesService.api_urls.csv + '&download=1';
		$window.open(url);
	}

	// Load with default query
	$scope.updateQuery()
	
})