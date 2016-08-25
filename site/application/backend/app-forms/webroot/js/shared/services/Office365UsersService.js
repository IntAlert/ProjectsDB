app.factory('Office365UsersService', function($http) {
  var instance = {
  	all: [],
  }

  // All countries
  $http.get('/api/Office365Users/all')
	.then(function(response){
		instance.all = response.data.data;

	}, function(){
		console.log("users download error")
	});

  return instance;
});