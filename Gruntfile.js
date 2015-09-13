module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);


	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

    dirs: {
      output: 'dist'
    },

		clean: {
      build: { 
        src: '<%= dirs.output %>/*' 
      }, 
    },

		less: {
      build: {
        options: {
          compress: true,
          optimization: 2
        },
        files: {
          '<%= dirs.output %>/css/built.css': [
            'bower_components/bootstrap/less/bootstrap.less', 
            'bower_components/font-awesome/css/font-awesome.css'
            'src/**/*.css', 
            'src/**/*.less'
          ]
        }
      }
    },

    cssmin: {
      options: {
        report: 'gzip',
        keepSpecialComments: 0
      },
      build: {
        files: {
          'web/css/app.min.css': '<%= dirs.output %>/css/built.css'
        }
      }
    }, 

    concat: {
      options: {
        separator: ';', // permet d'ajouter un point-virgule entre chaque fichier concaténé.
      },
      dist: {
        src: [
        	'bower_components/jquery/dist/jquery.js',
        	'bower_components/bootsrap/dist/js/bootstrap.js',
          'bower_components/bootsrap/js/*.js', 
          'src/**/*.js'
        ], 
        dest: '<%= dirs.output %>/js/built.js' // la destination finale
      }
    }, 

    uglify: {
      options: {
        banner: '/*\n <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n', 
        mangle: false,
        sourceMap: false
      },
      dist: {
        files: {
          'web/js/app.min.js': [
            '<%= dirs.output %>/js/built.js',
          ]
        }
      }
    }, 

    watch: {
      stylesheets: { 
        files: ['src/**/*.css', 'src/**/*.less'], 
        tasks: ['css'] 
      },
      scripts: { 
        files: 'src/**/*.js', 
        tasks: ['javascript'] 
      } 
    }

	});

	grunt.registerTask('default', ['clean', 'css', 'javascript']);
  grunt.registerTask('css', ['less', 'cssmin']);
  grunt.registerTask('javascript', ['concat', 'uglify']);

}
