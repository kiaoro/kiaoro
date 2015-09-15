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

    copy: {
      dist: {
       files: [{
         expand: true,
         cwd: 'bower_components/font-awesome/fonts/',
         src: ['*'],
         dest: 'web/fonts/'
       }, 
       {
         expand: true,
         cwd: 'bower_components/jquery/dist/',
         src: ['jquery.min.js'],
         dest: 'web/js/'
       }]
      }
    },

		less: {
      build: {
        options: {
          compress: true,
          optimization: 2
        },
        files: {
          '<%= dirs.output %>/css/built.css': [
            'bower_components/bootstrap/dist/css/bootstrap.css', 
            'bower_components/font-awesome/css/font-awesome.min.css', 
            'bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 
            'src/Naissance/**/*.css', 
            'src/Naissance/**/*.less'
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
        separator: ';',
      },
      dist: {
        src: [
        	'bower_components/bootsrap/dist/js/bootstrap.min.js',
          'bower_components/moment/min/moment.min.js', 
          'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 
          'src/Naissance/**/*.js'
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
        files: ['src/Naissance/**/*.css', 'src/Naissance/**/*.less'], 
        tasks: ['css'] 
      },
      scripts: { 
        files: 'src/Naissance/**/*.js', 
        tasks: ['javascript'] 
      } 
    }

	});

	grunt.registerTask('default', ['clean', 'copy', 'css', 'javascript']);
  grunt.registerTask('css', ['less', 'cssmin']);
  grunt.registerTask('javascript', ['concat', 'uglify']);

}
