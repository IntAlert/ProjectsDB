
var app = angular
	.module('resultsframework', ['ngMaterial', 'ngMessages', "checklist-model"])
	.config(function($mdDateLocaleProvider, $locationProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};

		$locationProvider.html5Mode({
			enabled: true,
			rewriteLinks: false
		});
	})




