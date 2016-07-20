
var app = angular
	.module('travelapplication', ['ngMaterial', 'ngMessages'])
	.config(function($mdDateLocaleProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};
	})


app.factory('travelapplicationService', function($http) {
  var travelapplicationServiceInstance = {};
  // factory function body that constructs shinyNewServiceInstance


  travelapplicationServiceInstance.getById = function(id) {

  	return $http.get('/forms/travelapplications/viewJson/' + id)
		.then(function(response){

			// format dates for itinerary
			for (var i = 0; i < response.data.itinerary.length; i++) {
				response.data.itinerary[i].start = new Date(response.data.itinerary[i].start)
				response.data.itinerary[i].finish = new Date(response.data.itinerary[i].finish)
			};

			// format dates for meetings
			for (var i = 0; i < response.data.schedule.length; i++) {
				response.data.schedule[i].date = new Date(response.data.schedule[i].date)
			};

			return(response.data)

		}, function(){
			alert("Failed to find application")
		});

  }

  return travelapplicationServiceInstance;
});