module.exports = (grunt) ->
  cwd = __dirname

  #grunt.log.write('grunt\n')

  # Project configuration.
  grunt.initConfig
    pkg: grunt.file.readJSON("package.json")
    copy:
      main:
        files: [
          {
            src: "www/vendor/twitter/bootstrap/dist/css/bootstrap.min.css"
            dest: "www/public/css/bootstrap.min.css"
          },
          {
            src: "www/vendor/twitter/bootstrap/dist/js/bootstrap.min.js"
            dest: "www/public/js/bootstrap.min.js"
          },
          {
            src: "www/vendor/components/jquery/jquery.min.js"
            dest: "www/public/js/jquery.min.js"
          },
          {
            flatten: true
            expand: true
            filter: 'isFile'
            src: "www/vendor/twitter/bootstrap/dist/fonts/*"
            dest: "www/public/fonts/"
          }

        ]
    compass:
      dev:
        options:
          cssPath: "public/framework/app/webroot/css"
          sassPath: "public/framework/app/webroot/sass"
    watch:
      compass:
#        files: "**/*.sass"
        files: "public/framework/app/webroot/**/*.sass"
        tasks: ["compass"]
        options:
          debounceDelay: 250


  # Load the plugin that provides the "uglify" task.
  #grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks "grunt-contrib-compass"
  grunt.loadNpmTasks "grunt-contrib-watch"
  grunt.loadNpmTasks "grunt-contrib-copy"

  # Default task(s).
  grunt.registerTask "default", ["compass"]