


app.controller('TravelapplicationController', function ($scope, $http, $window, $location, $anchorScroll, travelapplicationService) {


	// UI
	$scope.disableTabsByValid = true;

	// debug
	// $scope.disableTabsByValid = false;
	// $scope.selectedTabIndex = 3;

	// data for form fields
	$scope.users = [];
	$scope.territories = [];


	// all form fields
	$scope.formData = {

		"mode": 'has-office', // [no-office | has-office]

		// Applicant
		"applicant": {
			"id": "",
			"name": "",
			"role_category": "",
			"role_category_other": "",
			"role": "",
			"reason": "",
			"approving_manager": ""
		},

		// Contact Home
		"contact_home": {
			"user": false,
			"email": "",
			"tel_land": "",
			"tel_mobile": "",
			"freqency_of_contact": ""
		},

		// Contact In-country
		"contact_incountry": {
			"name": "",
			"email": "",
			"tel_land": "",
			"tel_mobile": "",
			"freqency_of_contact": ""
		},

		"risks": {
			"overview": "",
			"protection": "",
			"emergency_plan": "",
			"sources": ""
		},

		"contact_other": {
			"alert": "",
			"embassies": "",
			"emergency": "",
			"medical": ""
		},

		// Itinerary
		"itinerary": [{
			"start": "",
			"finish": "",
			"origin": "",
			"destination": "",

			"transport_detail": "",
			"transport_emails": "",
			"transport_tels": "",

			"accommodation_detail": "",
			"accommodation_emails": "",
			"accommodation_tels": "",
		}],

		// Schedule
		"schedule": [
		// {
		// 	"date": "",
		// 	"time": "",
		// 	"org_contact": "",
		// 	"address": "",
		// 	"email": "",
		// 	"confirmed": false
		// }
		],

		// tickboxes
		"convenant_agreed": false,
		"policy_understood": false,
		"evacuation_understood": false,
		"conduct_understood": false,
		"countrymanager_notified": false
	};


	// Watch data
	$scope.$watch('formData.contact_home.user', function() {
		if ($scope.formData.contact_home.user) {
			$scope.formData.contact_home.email = $scope.formData.contact_home.user.Office365user.email	
		}
		
	}, true);

	$scope.$watch('formData.contact_incountry.user', function() {
		if ($scope.formData.contact_incountry.user) {
			$scope.formData.contact_incountry.email = $scope.formData.contact_incountry.user.Office365user.email
		}
	}, true);

	// This user
	$scope.formData.applicant.id = me.id
	$scope.formData.applicant.name = me.name

	// Load data for select boxes
	// All users
	$http.get('/api/users/all.json')
		.then(function(response){
			$scope.users = response.data;

			// All geographical territories
			$http.get('/api/territories/allGeographical.json')
				.then(function(response){
					$scope.territories = response.data;
				}, function(territories){
					alert("territories download error")
				});

			downloadIfEdit()


		}, function(users){
			alert("Users download error")
		});

	

		function downloadIfEdit() {
			// Determine if add or edit
			var parts = window.location.pathname.split('/')
			if (parts[parts.length - 2] == 'edit') {
				var TravelApplicationID = parts[parts.length - 1]
				// Get travelapplication JSON
				travelapplicationService.getById(TravelApplicationID)
					.then(function(data){
						$scope.formData = data;
					}, function(){
						alert('error')
					})

			}	
		}



	// Load data


	

	
	$scope.changeActiveTab = function(i) {
		
		$scope.selectedTabIndex = i

		$location.hash('tabs');
		$anchorScroll();

	}

	$scope.addItineraryItem = function() {
		$scope.formData.itinerary.push({})
	}

	$scope.removeItineraryItem = function(i) {
		if (confirm("Are you sure you want to remove this itinerary item?")) {
			$scope.formData.itinerary.splice(i,1)
		}
	}

	$scope.addScheduleItem = function() {
		$scope.formData.schedule.push({})
	}

	$scope.removeScheduleItem = function(i) {
		if (confirm("Are you sure you want to remove this schedule item?")) {
			$scope.formData.schedule.splice(i,1)
		}
	}

	$scope.submitTravelApplication = function() {
		
		var cleanFormData = angular.toJson($scope.formData)

		$http.post('/forms/travelapplications/add', cleanFormData)
			.then(function(){
				// success
				$location.path('/forms/travelapplications/mine');
			}, function(){
				// there has been an error
				console.log('there has been an error')
			})

	}



	// test data for has-office
	var testDataHasOffice = {  
	   "applicant":{  
	      "id":"4",
	      "name":"Alan Thomson",
	      "role_category":"Alert staff",
	      "role_category_other":"",
	      "role":"",
	      "reason":"Reason for my trip....",
	      "approving_manager":{  
	         "User":{  
	            "id":"5",
	            "last_name":"Bair",
	            "first_name":"Ashleigh",
	            "name_formal":"Bair, Ashleigh"
	         },
	         "Office365user":{  
	            "email":"ABair@international-alert.org"
	         }
	      },
	      "role_text":"My role at Alert"
	   },
	   "contact_home":{  
	      "user":{  
	         "User":{  
	            "id":"87",
	            "last_name":"Baloch",
	            "first_name":"Shahhan",
	            "name_formal":"Baloch, Shahhan"
	         },
	         "Office365user":{  
	            "email":"Sbaloch@international-alert.org"
	         }
	      },
	      "email":"Sbaloch@international-alert.org",
	      "tel_land":"234234234",
	      "tel_mobile":"23423423423",
	      "skype":"afsdafasd",
	      "freqency_of_contact":"Often"
	   },
	   "contact_incountry":{  
	      "name":"",
	      "email":"",
	      "tel_land":"",
	      "tel_mobile":"",
	      "skype":"",
	      "freqency_of_contact":""
	   },
	   "risks":{  
	      "overview":"Answer to: What are the main safety and security risks in the locations which you will visit?",
	      "protection":"Answer to: How will you protect yourself against these risks?",
	      "emergency_plan":"",
	      "sources":"Answer to: Sources of security information used"
	   },
	   "contact_other":{  
	      "alert":"",
	      "embassies":"",
	      "emergency":"",
	      "medical":""
	   },
	   "itinerary":[  
	      {  
	         "start":new Date("2016-07-17T23:00:00.000Z"),
	         "finish":"2016-07-18T23:00:00.000Z",
	         "origin":{  
	            "Territory":{  
	               "id":"1",
	               "name":"Abkhazia",
	               "iso3":"GEO",
	               "iso":"GE",
	               "active":true,
	               "sort_order":"-1"
	            }
	         },
	         "destination":{  
	            "Territory":{  
	               "id":"18",
	               "name":"Afghanistan",
	               "iso3":"AFG",
	               "iso":"AF",
	               "active":true,
	               "sort_order":"-1"
	            }
	         },
	         "transport_detail":"",
	         "transport_emails":"",
	         "transport_tels":"",
	         "accommodation_detail":"",
	         "accommodation_emails":"",
	         "accommodation_tels":"",
	         "transport":{  
	            "detail":"Some detail on transport",
	            "email":"email@email.com",
	            "phone":"324234324234"
	         },
	         "accommodation":{  
	            "detail":"Some detail on accommodation",
	            "email":"email@email.com",
	            "phone":"234233423423"
	         }
	      },
	      {  
	         "start":"2016-07-18T23:00:00.000Z",
	         "finish":"2016-07-20T23:00:00.000Z",
	         "origin":{  
	            "Territory":{  
	               "id":"21",
	               "name":"Ethiopia",
	               "iso3":"ETH",
	               "iso":"ET",
	               "active":true,
	               "sort_order":"-1"
	            }
	         },
	         "destination":{  
	            "Territory":{  
	               "id":"37",
	               "name":"DRC",
	               "iso3":"COD",
	               "iso":"CO",
	               "active":true,
	               "sort_order":"-1"
	            }
	         },
	         "transport":{  
	            "detail":"Transport Detail #2",
	            "email":"trans_email2@email2.com",
	            "phone":"32423423"
	         },
	         "accommodation":{  
	            "email":"acc_email2@email2.com",
	            "phone":"423234234234",
	            "detail":"Accommodation Detail #2"
	         }
	      }
	   ],
	   "schedule":[  
	      {  
	         "date":"2016-07-12T23:00:00.000Z",
	         "time":"12:12",
	         "org_contact":"Some org and contact",
	         "address":"A full address",
	         "email":"meeting@meeting.com",
	         "confirmed":false
	      },
	      {  
	         "date":"2016-07-19T23:00:00.000Z",
	         "time":"25:25",
	         "org_contact":"Some org and contact #2",
	         "address":"A full address #2",
	         "email":"meeting2@email.com",
	         "confirmed":true
	      }
	   ],
	   "convenant_agreed":true,
	   "policy_understood":true,
	   "evacuation_understood":true,
	   "conduct_understood":true,
	   "countrymanager_notified":true
	}
	
	// fixture for debugging
	// $scope.formData = testDataHasOffice

});

