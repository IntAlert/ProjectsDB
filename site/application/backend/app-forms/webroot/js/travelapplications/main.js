
var app = angular
	.module('travelapplication', ['ngMaterial', 'ngMessages'])
	.config(function($mdDateLocaleProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};
	})



app.controller('TravelapplicationController', function ($scope, $http, $window) {


	// UI
	$scope.selectedTabIndex = 1;

	// data for form fields
	$scope.users = [];
	$scope.territories = [];


	// UI mode [no-office | has-office]
	$scope.mode = 'has-office';

	// all form fields
	$scope.formData = {


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



	// Load data

	// This user
	$scope.formData.applicant.id = me.id
	$scope.formData.applicant.name = me.name


	// All users
	$http.get('/api/users/all.json')
		.then(function(response){
			$scope.users = response.data;
		}, function(users){
			alert("Users download error")
		});

	// All geographical territories
	$http.get('/api/territories/allGeographical.json')
		.then(function(response){
			$scope.territories = response.data;
		}, function(territories){
			alert("territories download error")
		});

	


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

