app.factory('TravelapplicationsService', function($http) {
  var instance = {}

// $data = array(
// 			'destination_territory_id' => -1,
// 			'date' => '2016-07-27',
// 			'contact_id' => 'f1a3aea2-0302-4982-b373-74ac88195268'
// 		);

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
  

  return instance;
});