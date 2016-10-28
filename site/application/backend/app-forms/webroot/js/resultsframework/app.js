
var app = angular
	.module('resultsframework', ['ngMaterial', 'ngMessages', "checklist-model"])
	.config(function($mdDateLocaleProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};
	})




