module.exports = function(grunt) {
    
    // Initialize the grunt configuration
    grunt.initConfig({

        notify: {
            task_name: {
              options: {
                // Task-specific options go here.
              }
            },
            watch_css: {
              options: {
                title: 'Task Complete',
                message: 'CSS minified to public/css/main.css',
              }
            },
            watch_js: {
              options: {
                title: 'Task Complete',
                message: 'JS concatenated to public/js/main.js',
              }
            },
            server: {
              options: {
                title: 'Grunt Rocks!',
                message: 'Server is ready and waiting...'
              }
            }
        },

        // less file compilation and compression
        less: {
            development: {
                options: {
                    compress: true
                },
                files: {  
                    './public/assets/css/frontend.css' : './app/assets/less/frontend.less',
                    './public/assets/css/backend.css'  : './app/assets/less/backend.less'
                }
            }
        },

        cssmin: {
          add_banner: {
            options: {
              banner: '/* My minified css file */'
            },
            files: {
                './public/css/main.css': 
                [
                    './app/assets/components/bower/jquery-ui/themes/redmond/jquery-ui.css',
                    './app/assets/components/bower/bootstrap/dist/css/bootstrap.css',
                    './app/assets/components/bower/datatables/media/css/jquery.dataTables.css',
                    './app/assets/components/bower/toastr/toastr.css',
                    './app/assets/css/master.css',
                    './app/assets/css/custom.css'
                ]
            }
          }
        },
        // JS file concatenation
          concat: {
            options: {
              separator: ';',
            },
            dist: {
              src: [
                './app/assets/components/bower/jquery/jquery.js',
                './app/assets/components/bower/jquery-ui/jquery-ui.js',
                './app/assets/components/bower/bootstrap/dist/js/bootstrap.js',
                './app/assets/components/bower/datatables/media/js/jquery.dataTables.js',
                './app/assets/js/jqprint.js',
                './app/assets/js/main.js',
                './app/assets/js/master.js',
                './app/assets/js/barcode.js',
                './app/assets/js/jquery_confirm.js',
                './app/assets/components/bower/toastr/toastr.js',
              ],
              dest: './public/js/main.js',
            },
          },

        // copy ressources such as fonts, files, images, required by assets to the public directory
        copy : {
            fonts: {
                expand: true,
                cwd : './app/assets/components/bower/bootstrap/dist/fonts/',
                src: ['*'],
                dest: './public/fonts/'
            },
            js : {
                expand: true,
                cwd : './app/assets/components/bower/modernizr/',
                src: ['modernizr.js'],
                dest: './public/assets/js/'  
            }
        },

        // JS file obfuscation
        uglify: {
            dist: {
                files: {
                  './public/js/main.js' : './public/js/main.js'
                }
            }
        },

        // run PHP unit tests
        phpunit: {
            classes: {
                dir: 'app/tests/'
            },
            options: {
                bin: 'vendor/bin/phpunit',
                colors: true
            }
        },

        // automatically run tasks when changing JS, LESS or PHP files
        watch: {
            js: {
                files: ['./app/assets/js/*.*'],
                tasks: ['concat', 'notify:watch_js'],
                options: {
                    livereload: true,
                }
            },
            cssmin: {
                files: ['./app/assets/css/**/*.css'],
                tasks: ['cssmin', 'notify:watch_css'],
                options: {
                    livereload: true
                }
            },
            less: {
                files: ['./app/assets/less/*.*'],
                tasks: ['less', 'notify:watch'],
                options: {
                    livereload: true
                }
            },
            php: {
                files: [
                    'app/views/*.php'
                ],
                options: {
                    livereload: true
                }
            }      
        }
    });

    // Load grunt plugins
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-notify');
    grunt.loadNpmTasks('grunt-phpunit');

    grunt.registerTask('dev', ['cssmin', 'concat', 'notify:server', 'watch']);

    grunt.registerTask('build', ['cssmin', 'concat', 'uglify', 'copy', 'watch']);

};