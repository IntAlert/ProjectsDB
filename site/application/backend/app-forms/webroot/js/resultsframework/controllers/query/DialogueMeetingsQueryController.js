app.controller('DialogueMeetingsQueryController', function($scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, MeetingsService){

	$scope.data = MeetingsService
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
		  { name:'Project Id', field: 'Meeting.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Meeting Id', field: 'Meeting.id', visible:false },
		  { name:'Meeting Title', field: 'Meeting.title' },
		  { name:'Males', field: 'Meeting.male_count' },
		  { name:'Females', field: 'Meeting.female_count' },
		  { name:'Start Date', field: 'Meeting.start_date', visible:false },
		  { name:'Finish Date', field: 'Meeting.finish_date'},
		],
		
		enableGridMenu:true,
		exporterCsvFilename: 'meetings.csv',
		exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		MeetingsService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = MeetingsService.items
				$scope.state.data_loading = false
			})
	}

	// Load with default query
	$scope.updateQuery()
	
})