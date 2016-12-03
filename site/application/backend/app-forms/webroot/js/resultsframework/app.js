
var app = angular
	.module('resultsframework', ['ngMaterial', 'ngMessages', "checklist-model", 'ui.grid', 'ui.grid.selection', 'ui.grid.exporter', 'ngclipboard'])
	.config(function($mdDateLocaleProvider, $locationProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};

		$locationProvider.html5Mode({
			enabled: true,
			rewriteLinks: false
		});
	})


app.filter('dateToISO', function() {
  return function(input) {
    return new Date(input).toISOString();
  };
});

