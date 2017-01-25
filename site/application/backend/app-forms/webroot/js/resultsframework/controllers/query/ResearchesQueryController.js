app.controller('ResearchesQueryController', function($scope, $mdDialog, ResultsFrameworkService, FormOptions, ResearchesService){

	$scope.data = ResearchesService
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
		  { name:'Project Id', field: 'Research.project_id', visible:false },
		  { name:'Project Name', field: 'Project.title'},
		  { name:'Research Id', field: 'Research.id', visible:false },
		  { name:'Research Title', field: 'Research.title' },
		  { name:'Start Date', field: 'Research.start_date', visible:false },
		  { name:'Finish Date', field: 'Research.finish_date'},
		],
		
		enableGridMenu:true,
		exporterCsvFilename: 'researches.csv',
		exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
	    onRegisterApi: function(gridApi){
	      $scope.gridApi = gridApi;
	    },

		data: []
	};

	$scope.updateQuery = function(){
		$scope.state.data_loading = true
		ResearchesService.query($scope.query)
			.then(function(){
				$scope.gridOptions.data = ResearchesService.items
				$scope.state.data_loading = false
			})
	}

	// Load with default query
	$scope.updateQuery()
	
})