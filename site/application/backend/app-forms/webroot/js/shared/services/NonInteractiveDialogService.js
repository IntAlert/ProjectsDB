app.factory('NonInteractiveDialogService', function($mdDialog) {
  var instance = {
    show: function(title, msg, ev) {

		$mdDialog.show({
          targetEvent: ev,
          clickOutsideToClose: false,
          parent: document.body,
    		  escapeToClose: false,
          template:
            '<md-dialog>' +

            '  <md-toolbar> ' +
            '    <div class="md-toolbar-tools"> ' +
            '      <h2>'+title+'</h2> ' +
            '    </div> ' +
            '  </md-toolbar> ' +

            '  <md-dialog-content layout-padding><p>' + msg + '</p>' +
            '  </md-dialog-content>' +
            '</md-dialog>'
        });
	},
	hide: function() {
		$mdDialog.hide()
	}
  }

  return instance;
});