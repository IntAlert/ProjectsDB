app.controller('TravelapplicationEditController', function ($scope, $window, $location, $timeout, $anchorScroll, $localStorage, TravelapplicationsService, Office365UsersService, NonInteractiveDialogService, CountriesService) {

	$scope.TravelApplicationID = false;

	// UI
	$scope.disableTabsByValid = true;

	// debug
	// $scope.disableTabsByValid = false;
	// $scope.selectedTabIndex = 7;

	// data for form fields
	$scope.countries = CountriesService;
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


	// keep all data in scope saved in localStorage until successful save
	var localCache = $localStorage.$default({
		'formData': $scope.formData
	});

	$scope.formData = localCache.formData

	// This user
	$scope.formData.applicant.id = me.id
	$scope.formData.applicant.name = me.name

	// Determine if add or edit
	var parts = window.location.pathname.split('/')
	if (parts[parts.length - 2] == 'edit') {
		$scope.TravelApplicationID = parts[parts.length - 1]
	}
	console.log($scope.TravelApplicationID);



	// Show loading until form data available
	NonInteractiveDialogService.show('Loading', 'Please wait while we load your form options...', null);
	$scope.$watch('[countries.all, office365Users.all]', function() {
		if ($scope.countries.all.length && $scope.office365Users.all.length) {
			NonInteractiveDialogService.hide()
		}
	}, true);



	// Load data if this is an existing application
	function downloadIfEdit() {
		if ($scope.TravelApplicationID) {
			// Get travelapplication JSON
			TravelapplicationsService.getById($scope.TravelApplicationID)
				.then(function(data){
					$scope.formData = data;
				}, function(){
					alert('Error downloading Trip')
				})
		}
	}


	// UX functions
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
		
		// Tell user to wait
		NonInteractiveDialogService.show('Saving', 'Your trip is being saved and sent to your nominated contacts...', null);

		// save it!
		TravelapplicationsService.save($scope.formData, $scope.TravelApplicationID)
			.then(function(){
				// success
				console.log('save success')

				// clear local storage
				$localStorage.$reset();
				$timeout(function(){
				   window.location.href = '/forms/travelapplications';
				});

				
			}, function(){
				// there has been an error
				alert('there has been an error')
			})

	}

	downloadIfEdit();
	
	
	// fixture for debugging
	// $scope.formData = TravelapplicationsService.getDummyData()

});

