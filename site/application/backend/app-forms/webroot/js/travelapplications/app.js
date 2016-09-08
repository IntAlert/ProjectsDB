
var app = angular
	.module('travelapplication', ['ngMaterial', 'ngMessages'])
	.config(function($mdDateLocaleProvider, $locationProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};

		$locationProvider.html5Mode(true);
	})


// app.factory('travelapplicationService', function($http) {
//   var travelapplicationServiceInstance = {};
//   // factory function body that constructs shinyNewServiceInstance


//   travelapplicationServiceInstance.getById = function(id) {

//   	return $http.get('/forms/travelapplications/viewJson/' + id)
// 		.then(function(response){

// 			// format dates for itinerary
// 			for (var i = 0; i < response.data.itinerary.length; i++) {
// 				response.data.itinerary[i].start = new Date(response.data.itinerary[i].start)
// 				response.data.itinerary[i].finish = new Date(response.data.itinerary[i].finish)
// 			};

// 			// format dates for meetings
// 			for (var i = 0; i < response.data.schedule.length; i++) {
// 				response.data.schedule[i].date = new Date(response.data.schedule[i].date)
// 			};

// 			return(response.data)

// 		}, function(){
// 			alert("Failed to find application")
// 		});

//   }

//   travelapplicationServiceInstance.getDummyData = function() {

//   	// test data for has-office
// 	var testDataHasOffice = {  
// 	   "applicant":{  
// 	      "id":"4",
// 	      "name":"Alan Thomson",
// 	      "role_category":"Alert staff",
// 	      "role_category_other":"",
// 	      "role":"",
// 	      "reason":"Reason for my trip....",
// 	      "approving_manager":{  
// 	         "User":{  
// 	            "id":"5",
// 	            "last_name":"Bair",
// 	            "first_name":"Ashleigh",
// 	            "name_formal":"Bair, Ashleigh"
// 	         },
// 	         "Office365user":{  
// 	            "email":"ABair@international-alert.org"
// 	         }
// 	      },
// 	      "role_text":"My role at Alert"
// 	   },
// 	   "contact_home":{  
// 	      "user":{  
// 	         "User":{  
// 	            "id":"87",
// 	            "last_name":"Baloch",
// 	            "first_name":"Shahhan",
// 	            "name_formal":"Baloch, Shahhan"
// 	         },
// 	         "Office365user":{  
// 	            "email":"Sbaloch@international-alert.org"
// 	         }
// 	      },
// 	      "email":"Sbaloch@international-alert.org",
// 	      "tel_land":"234234234",
// 	      "tel_mobile":"23423423423",
// 	      "skype":"afsdafasd",
// 	      "freqency_of_contact":"Often"
// 	   },
// 	   "contact_incountry":{  
// 	      "name":"",
// 	      "email":"",
// 	      "tel_land":"",
// 	      "tel_mobile":"",
// 	      "skype":"",
// 	      "freqency_of_contact":""
// 	   },
// 	   "risks":{  
// 	      "overview":"Answer to: What are the main safety and security risks in the locations which you will visit?",
// 	      "protection":"Answer to: How will you protect yourself against these risks?",
// 	      "emergency_plan":"",
// 	      "sources":"Answer to: Sources of security information used"
// 	   },
// 	   "contact_other":{  
// 	      "alert":"",
// 	      "embassies":"",
// 	      "emergency":"",
// 	      "medical":""
// 	   },
// 	   "itinerary":[  
// 	      {  
// 	         "start":new Date("2016-07-17T23:00:00.000Z"),
// 	         "finish":"2016-07-18T23:00:00.000Z",
// 	         "origin":{  
// 	            "Territory":{  
// 	               "id":"1",
// 	               "name":"Abkhazia",
// 	               "iso3":"GEO",
// 	               "iso":"GE",
// 	               "active":true,
// 	               "sort_order":"-1"
// 	            }
// 	         },
// 	         "destination":{  
// 	            "Territory":{  
// 	               "id":"18",
// 	               "name":"Afghanistan",
// 	               "iso3":"AFG",
// 	               "iso":"AF",
// 	               "active":true,
// 	               "sort_order":"-1"
// 	            }
// 	         },
// 	         "transport_detail":"",
// 	         "transport_emails":"",
// 	         "transport_tels":"",
// 	         "accommodation_detail":"",
// 	         "accommodation_emails":"",
// 	         "accommodation_tels":"",
// 	         "transport":{  
// 	            "detail":"Some detail on transport",
// 	            "email":"email@email.com",
// 	            "phone":"324234324234"
// 	         },
// 	         "accommodation":{  
// 	            "detail":"Some detail on accommodation",
// 	            "email":"email@email.com",
// 	            "phone":"234233423423"
// 	         }
// 	      },
// 	      {  
// 	         "start":"2016-07-18T23:00:00.000Z",
// 	         "finish":"2016-07-20T23:00:00.000Z",
// 	         "origin":{  
// 	            "Territory":{  
// 	               "id":"21",
// 	               "name":"Ethiopia",
// 	               "iso3":"ETH",
// 	               "iso":"ET",
// 	               "active":true,
// 	               "sort_order":"-1"
// 	            }
// 	         },
// 	         "destination":{  
// 	            "Territory":{  
// 	               "id":"37",
// 	               "name":"DRC",
// 	               "iso3":"COD",
// 	               "iso":"CO",
// 	               "active":true,
// 	               "sort_order":"-1"
// 	            }
// 	         },
// 	         "transport":{  
// 	            "detail":"Transport Detail #2",
// 	            "email":"trans_email2@email2.com",
// 	            "phone":"32423423"
// 	         },
// 	         "accommodation":{  
// 	            "email":"acc_email2@email2.com",
// 	            "phone":"423234234234",
// 	            "detail":"Accommodation Detail #2"
// 	         }
// 	      }
// 	   ],
// 	   "schedule":[  
// 	      {  
// 	         "date":"2016-07-12T23:00:00.000Z",
// 	         "time":"12:12",
// 	         "org_contact":"Some org and contact",
// 	         "address":"A full address",
// 	         "email":"meeting@meeting.com",
// 	         "confirmed":false
// 	      },
// 	      {  
// 	         "date":"2016-07-19T23:00:00.000Z",
// 	         "time":"25:25",
// 	         "org_contact":"Some org and contact #2",
// 	         "address":"A full address #2",
// 	         "email":"meeting2@email.com",
// 	         "confirmed":true
// 	      }
// 	   ],
// 	   "convenant_agreed":true,
// 	   "policy_understood":true,
// 	   "evacuation_understood":true,
// 	   "countrymanager_notified":true
// 	}

// 	// format dates for itinerary
// 	for (var i = 0; i < testDataHasOffice.itinerary.length; i++) {
// 		testDataHasOffice.itinerary[i].start = new Date(testDataHasOffice.itinerary[i].start)
// 		testDataHasOffice.itinerary[i].finish = new Date(testDataHasOffice.itinerary[i].finish)
// 	};

// 	// format dates for meetings
// 	for (var i = 0; i < testDataHasOffice.schedule.length; i++) {
// 		testDataHasOffice.schedule[i].date = new Date(testDataHasOffice.schedule[i].date)
// 	};

//   	return testDataHasOffice;
//   }

//   return travelapplicationServiceInstance;
// });