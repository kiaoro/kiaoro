module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);


	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		clean: {
      build: { 
        src: 'web/built' 
      }, 
    },

		less: {
      dist: {
        options: {
          compress: true,
          optimization: 2
        },
        files: {
          'web/css/main.css': [
            'bower_components/bootsrap/dist/less/bootstrap.less',
            //'src/Naissance/ApplicationBundle/Resources/public/less/main.less'
          ]
        }
      }
    },


    concat: {
      options: {
        separator: ';', // permet d'ajouter un point-virgule entre chaque fichier concaténé.
      },
      dist: {
        src: [
        	'bower_components/bootsrap/dist/jquery.js',
        	'bower_components/bootsrap/dist/js/bootstrap.js',
          'bower_components/bootsrap/js/*.js', 
        ], 
        dest: 'web/built/js/built.js' // la destination finale
      }
    }, 

    uglify: {
      options: {
        mangle: false,
        sourceMap: true
      },
      dist: {
        files: {
          'web/built/js/built.min.js': [
            'web/built/js/built.js',
          ]
        }
      }
    }
    

	});

	grunt.registerTask('default', ['css', 'javascript']);
  grunt.registerTask('css', ['less']);
  grunt.registerTask('javascript', ['concat', 'uglify']);

}
