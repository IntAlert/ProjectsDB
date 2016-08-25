app.factory('TravelapplicationsService', function($http) {
  var instance = {}

// $data = array(
// 			'destination_territory_id' => -1,
// 			'date' => '2016-07-27',
// 			'contact_id' => 'f1a3aea2-0302-4982-b373-74ac88195268'
// 		);

  instance.search = function(q) {
  	return $http.post('/forms/travelapplications/search', {
  		destination_territory_id: q.destination_territory_id,
  		date: q.date,
  		contact_o365_object_id: q.contact_o365_object_id,
  		applicant_o365_object_id: q.applicant_o365_object_id
  	})
	  .then(function(response){
	    return response.data;
	  }, function(){
	    console.log("travelapplications download error")
	  });
  }

  

  return instance;
});