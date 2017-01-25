
var app = angular
	.module('travelapplication', ['ngMaterial', 'ngMessages', 'ngStorage'])
	.config(function($mdDateLocaleProvider, $locationProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};

		$mdDateLocaleProvider.parseDate = function(dateString) {

		    var m = moment(dateString, 'DD/MM/YYYY', true);
		    return m.isValid() ? m.toDate() : new Date(NaN);
		};

		$locationProvider.html5Mode(true);
	})