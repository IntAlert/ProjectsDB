app.factory('TravelapplicationsService', function($http) {
  var instance = {}

// $data = array(
// 			'destination_territory_id' => -1,
// 			'date' => '2016-07-27',
// 			'contact_id' => 'f1a3aea2-0302-4982-b373-74ac88195268'
// 		);


  instance.save = function(data, travelapplication_id) {

    // add or edit?
    if (travelapplication_id) {
      data.id = travelapplication_id
    }

    // clean it of Angular stuff
    var cleanFormData = angular.toJson(data)

    return $http.post('/forms/travelapplications/add', data)

  }

  instance.search = function(query) {
    return $http.post('/forms/travelapplications/search', {
      destination_territory_id: query.destination_territory_id,
      date: query.date,
      contact_o365_object_id: query.contact_o365_object_id,
      applicant_o365_object_id: query.applicant_o365_object_id
    })
    .then(function(response){
      return response.data;
    }, function(){
      console.log("travelapplications download error")
    });
  }

  instance.getAll = function(query) {
    return $http.post('/forms/travelapplications/search', {
      destination_territory_id: -1,
      date: -1,
      contact_o365_object_id: -1,
      applicant_o365_object_id: -1
    })
    .then(function(response){
      return response.data;
    }, function(){
      console.log("travelapplications download error")
    });
  }

  instance.getMyTravelapplications = function() {
    return $http.get('/forms/travelapplications/mine2')
      .then(function(response){
        return response.data;
      }, function(){
        console.log("travelapplications download error")
      });
  }

  instance.getManagedTravelapplications = function(query) {

    console.log(query)
    return $http.post('/forms/travelapplications/managed2', {
      date: query.date,
      applicant_o365_object_id: query.applicant_o365_object_id
    })
      .then(function(response){
        return response.data;
      }, function(){
        console.log("travelapplications download error")
      });
  }

  instance.getById = function(id) {

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
  

  return instance;
});