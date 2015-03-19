
module.exports = function (grunt) {

	// load all grunt tasks
	// require('time-grunt')(grunt);
	require('load-grunt-tasks')(grunt);

	// var reloadPort = 35729;

	var banner_name = '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n';


	grunt.initConfig({
	  uglify: {
	    default: {
			options: {
				// mangle: false,
				// compress: false,
				// beautify: true
			},
	      files: {
				'site/application/frontend/js/script.min.js': [
					'site/application/frontend/js/jquery.min.js', 
					'site/application/frontend/js/bootstrap.min.js', 
					'site/application/frontend/js/api.js', 
					'site/application/frontend/js/app.js', 
					'site/application/frontend/js/main.js', 
					'site/application/frontend/js/enter.js'
				]				
	      }
	    }
	  },
		cssmin: {
		  options: {
		    shorthandCompacting: false,
		    roundingPrecision: -1
		  },
		  default: {
		    files: {
		      'site/application/frontend/css/style.min.css': [
			      'site/application/frontend/css/bootstrap.min.css', 
			      'site/application/frontend/css/style.css', 
		      ]
		    }
		  }
		}
	});


	grunt.registerTask('default', [
		"uglify", 
		"cssmin"
	]);

}