
app.factory('DedupeService', function() {
  var obj = {

  	themes: function (themesDuped) {

  		var ids = {}
  		var themesClean = []

  		angular.forEach(themesDuped, function(theme){
  			if ( !ids[theme.id] ) {
  				themesClean.push(theme)
  			}
  			ids[theme.id] = true
  		})

  		return themesClean;
  	},

    territories: function (territoriesDuped) {

      var ids = {}
      var territoriesClean = []

      angular.forEach(territoriesDuped, function(territory){
        if ( !ids[territory.id] ) {
          territoriesClean.push(territory)
        }
        ids[territory.id] = true
      })

      return territoriesClean;
    },

    participantTypes: function (participantTypesDuped) {

      var names = {}
      var participantTypesClean = []

      angular.forEach(participantTypesDuped, function(participantType){
        if ( !names[participantType.id] ) {
          participantTypesClean.push(participantType)
        }
        names[participantType.id] = true
      })

      return participantTypesClean;
    }

  }

  return obj

});
