
var app = angular
	.module('travelapplicationList', ['ngMaterial', 'ngMessages'])
	.config(function($mdDateLocaleProvider, $locationProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};
	})