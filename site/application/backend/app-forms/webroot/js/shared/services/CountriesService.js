app.factory('CountriesService', function($http) {
  var instance = {
    all: [],
  }

  // All countries
  $http.get('/api/territories/allCountries')
  .then(function(response){
    instance.all = response.data.data;
    console.log(response.data)

  }, function(){
    console.log("countries download error")
  });

  return instance;
});