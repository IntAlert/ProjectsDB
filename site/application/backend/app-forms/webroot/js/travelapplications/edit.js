app.controller('TravelapplicationController', function ($scope, $http, $window, $location, $anchorScroll, travelapplicationService, Office365UsersService) {


	// UI
	$scope.disableTabsByValid = true;

	// debug
	// $scope.disableTabsByValid = false;
	// $scope.selectedTabIndex = 2;

	// data for form fields
	$scope.users = [];
	$scope.territories = [];
	$scope.office365Users = Office365UsersService


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
		"contact_hq": {
			"user": false,
			"email": "",
			"tel_land": "",
			"tel_mobile": "",
			"freqency_of_contact": ""
		},

		// Contact HQ
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
		"countrymanager_notified": false
	};




	// Watch data
	$scope.$watch('formData.contact_hq.user', function() {

		if ($scope.formData.contact_hq.user) {
			$scope.formData.contact_hq.email = $scope.formData.contact_hq.user.mail;
			$scope.formData.contact_hq.tel_land = $scope.formData.contact_hq.user.telephoneNumber;
			$scope.formData.contact_hq.tel_mobile = $scope.formData.contact_hq.user.mobile;
			$scope.formData.contact_hq.tel_skype = $scope.formData.contact_hq.user.userPrincipalName;
		}
		
	}, true);

	$scope.$watch('formData.contact_home.user', function() {
		if ($scope.formData.contact_home.user) {
			$scope.formData.contact_home.email = $scope.formData.contact_home.user.mail;
			$scope.formData.contact_home.tel_land = $scope.formData.contact_home.user.telephoneNumber;
			$scope.formData.contact_home.tel_mobile = $scope.formData.contact_home.user.mobile;
			$scope.formData.contact_home.tel_skype = $scope.formData.contact_home.user.userPrincipalName;
		}
		
	}, true);

	$scope.$watch('formData.contact_incountry.user', function() {
		if ($scope.formData.contact_incountry.user) {
			$scope.formData.contact_incountry.email = $scope.formData.contact_incountry.user.mail;
			$scope.formData.contact_incountry.tel_land = $scope.formData.contact_incountry.user.telephoneNumber;
			$scope.formData.contact_incountry.tel_mobile = $scope.formData.contact_incountry.user.mobile;
			$scope.formData.contact_incountry.tel_skype = $scope.formData.contact_incountry.user.userPrincipalName;
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
			$http.get('/api/territories/allCountries.json')
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
				window.location.href = '/forms/travelapplications/mine';
			}, function(){
				// there has been an error
				alert('there has been an error')
			})

	}



	
	
	// fixture for debugging
	// $scope.formData = travelapplicationService.getDummyData()

});

