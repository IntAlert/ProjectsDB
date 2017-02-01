
app.controller('ExportController', function($scope, $window, $mdDialog, TrainingsService, AccompanimentsService, MeetingsService, ProcessesService, ResearchesService, AdvocaciesService, OtherActivitiesService, ResultsService){

	// User Query
	$scope.query = {
		project_id: project_id, // set in edit.ctp by PHP
		dates: {
			all: false,
			start: new Date(new Date().getFullYear(), 0, 1), // first day of year
			finish: new Date(new Date().getFullYear(), 11, 31) // last day of year
		}
	}
	

	// executed on load and everytime query dates change
	$scope.updateApiUrls = function() {
		// copy the query var, 
		// otherwise we get run-away calls from the $watch function
		var query = angular.copy($scope.query); 

		TrainingsService.updateApiUrls(query);
		AccompanimentsService.updateApiUrls(query);
		ProcessesService.updateApiUrls(query);
		MeetingsService.updateApiUrls(query);
		ResearchesService.updateApiUrls(query);
		AdvocaciesService.updateApiUrls(query);
		OtherActivitiesService.updateApiUrls(query);
		ResultsService.updateApiUrls(query);
	}
	// create watch that triggers function above
	$scope.$watch('query', function(){
		$scope.updateApiUrls();
	}, true)

	$scope.exportTrainingData = function() {
		
		var url = TrainingsService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportAccompanimentData = function() {
		
		var url = AccompanimentsService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportDialogueProcessData = function() {
		
		var url = ProcessesService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportDialogueMeetingData = function() {
		
		var url = MeetingsService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportResearchData = function() {
		
		var url = ResearchesService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportAdvocacyData = function() {
		
		var url = AdvocaciesService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportOtherActivityData = function() {
		
		var url = OtherActivitiesService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.exportResultData = function() {
		
		var url = ResultsService.api_urls.csv + '&download=1';
		$window.open(url, '_blank');
	}

	$scope.updateApiUrls();



})
