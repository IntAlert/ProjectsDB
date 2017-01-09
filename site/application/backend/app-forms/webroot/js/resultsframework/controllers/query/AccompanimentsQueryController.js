
app.controller('AccompanimentsQueryController', function($scope, $mdDialog, DedupeService, ResultsFrameworkService, FormOptions, AccompanimentsService){

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
		  { name:'Accompaniment Title', field: 'Accompaniment.title' },
		  { name:'Start Date', field: 'Accompaniment.start_date', visible:false },
		  { name:'Finish Date', field: 'Accompaniment.finish_date'},
		],
		
		enableGridMenu:true,
		exporterCsvFilename: 'accompaniments.csv',
		exporterCsvLinkElement: angular.element(document.querySelectorAll(".custom-csv-link-location")),
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

	// Load with default query
	$scope.updateQuery()
	
})