app.factory('CountriesService', function($http) {
  var instance = {
    all: [],
  }

  // All countries
  $http.get('/api/territories/allCountries.json')
  .then(function(response){
    instance.all = response.data;

  }, function(){
    console.log("countries download error")
  });

  return instance;
});