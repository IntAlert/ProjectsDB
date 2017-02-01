
var app = angular
	.module('resultsframework', ['ngMaterial', 'ngMessages', "checklist-model", 'ui.grid', 'ui.grid.selection', 'ngclipboard'])
	.config(function($mdDateLocaleProvider, $locationProvider) {
		$mdDateLocaleProvider.formatDate = function(date) {
			return date ? moment(date).format('DD/MM/YYYY') : "";
		};


		// handles manual edit
		$mdDateLocaleProvider.parseDate = function(dateString) {
		    var m = moment(dateString, 'DD/MM/YYYY', true);
		    return m.isValid() ? m.toDate() : new Date(NaN);
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

