module.exports = function(grunt) {

	grunt.initConfig({

		uglify : {

			options : {
				banner : "/*! app.min.js file */\n"
			},
			build : {
				src : ["assets/frontend/js/before.js", "assets/frontend/js/app.js", "assets/frontend/js/after.js"],
				dest : "public/js/frontend.min.js"
			}

		}
		
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask("default", ["uglify"]);
}