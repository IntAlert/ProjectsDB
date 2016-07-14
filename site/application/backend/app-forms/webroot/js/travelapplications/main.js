
var app = angular
	.module('travelapplication', ['ngMaterial', 'ngMessages'])
	// .module('travelapplication', ['ui.bootstrap', 'ngSanitize'])
	// .config(function($sceDelegateProvider) {
	//   $sceDelegateProvider.resourceUrlWhitelist([
	//     // Allow same origin resource loads.
	//     'self',
	//     // Allow loading from outer templates domain.
	//     'https://s3-eu-west-1.amazonaws.com/zakat-dev-justgiving-com/**'
	//   ]); 
	// });



app.controller('TravelapplicationController', function ($scope, $http, $window) {

	// UI mode [no-office | has-office]
	$scope.mode = 'has-office';

	// all form fields
	$scope.formData = {


		// Applicant
		"applicant": {
			"name": "",
			"role_category": "",
			"role_category_other": "",
			"role": "",
			"reason": "",
			"approving_manager": ""
		},

		// Contact Home
		"contact_home": {
			"name": "",
			"email": "",
			"tel_land": "",
			"tel_mobile": "",
			"skype": "",
			"freqency_of_contact": ""
		},

		// Contact In-country
		"contact_incountry": {
			"name": "",
			"email": "",
			"tel_land": "",
			"tel_mobile": "",
			"skype": "",
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
		"schedule": [{
			"date": "",
			"time": "",
			"org_contact": "",
			"address": "",
			"email": "",
			"confirmed": false
		}],

		// tickboxes
		"convenant_agreed": false,
		"policy_understood": false,
		"evacuation_understood": false,
		"conduct_understood": false,
		"countrymanager_notified": false
	};


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

	


});

