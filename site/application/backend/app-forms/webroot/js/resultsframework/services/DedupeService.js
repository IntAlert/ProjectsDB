
app.factory('DedupeService', function() {
  var obj = {

  	themes: function (themesDuped) {

  		var ids = {}
  		var themesClean = []

  		angular.forEach(themesDuped, function(theme){
  			if ( !ids[theme.Theme.id] ) {
  				themesClean.push(theme)
  			}
  			ids[theme.Theme.id] = true
  		})

  		return themesClean;
  	},

    territories: function (territoriesDuped) {

      var ids = {}
      var territoriesClean = []

      angular.forEach(territoriesDuped, function(territory){
        if ( !ids[territory.Territory.id] ) {
          territoriesClean.push(territory)
        }
        ids[territory.Territory.id] = true
      })

      return territoriesClean;
    },

    participantTypes: function (participantTypesDuped) {

      var names = {}
      var participantTypesClean = []

      angular.forEach(participantTypesDuped, function(participantType){
        if ( !names[participantType.name] ) {
          participantTypesClean.push(participantType)
        }
        names[participantType.name] = true
      })

      return participantTypesClean;
    }

  }

  return obj

});
