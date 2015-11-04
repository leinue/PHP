/*
 * Generated on 2014-05-27
 * generator-assemble v0.4.11
 * https://github.com/assemble/generator-assemble
 *
 * Copyright (c) 2014 Hariadi Hinta
 * Licensed under the MIT license.
 */

'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// '<%= config.src %>/templates/pages/{,*/}*.hbs'
// use this if you want to match all subfolders:
// '<%= config.src %>/templates/pages/**/*.hbs'

module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);

    grunt.loadNpmTasks('assemble');

    // Project configuration.
    grunt.initConfig({
        config: {
            src: 'src',
            dist: 'dist',
            tmp: '.tmp'
        },

        /*********************************
        *   Reload watch
        *********************************/
        watch: {
            assemble: {
                files: ['<%= config.src %>/{content,data,templates,partials,helpers}/**/*.{md,hbs,yml,js}'],
                tasks: ['assemble']
            },

            livereload: {
                options: {
                    livereload: '<%= connect.options.livereload %>'
                },
                files: [
                    '<%= config.tmp %>/{,*/}*.html',
                    '<%= config.tmp %>/assets/{,*/}*.css',
                    '<%= config.tmp %>/assets/{,*/}*.js'
                ]
            },

            gruntfile: {
                files: ['Gruntfile.js']
            },

            compass: {
                files: ['<%= config.src %>/assets/scss/{,*/}*.{scss,sass}'],
                tasks: ['compass']
            },

            javascripts: {
                files: ['<%= config.src %>/assets/js/{,*/}*.js'],
                tasks: ['copy']
            },

            images: {
                files: ['<%= config.src %>/assets/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'],
                tasks: ['copy:tmp']
            }

        },

        /*********************************
        *   Server
        *********************************/
        connect: {
            options: {
                port: 9002,
                livereload: 35728,
                // change this to '0.0.0.0' to access the server from outside
                hostname: 'localhost'
            },
            livereload: {
                options: {
                    open: true,
                    base: [
                        '.tmp'
                    ]
                }
            }
        },

        /*********************************
        *   Assemble
        *********************************/
        assemble: {
            pages: {
                options: {
                    flatten: true,
                    assets: '<%= config.src %>/assets',
                    layout: 'default.hbs',
                    layoutdir: '<%= config.src %>/templates/layouts',
                    data: '<%= config.src %>/data/*.{json,yml}',
                    partials: '<%= config.src %>/templates/partials/{,*/}*.hbs',
                    helpers: '<%= config.src %>/templates/helpers/**/*.js',
                },
                files: {
                    '<%= config.tmp %>/': ['<%= config.src %>/templates/pages/**/{*.md,*.hbs}']
                }
            }
        },


        /*********************************
        *   COMPASS
        *********************************/
        compass: {
            options: {
                sassDir: '<%= config.src %>/assets/scss',
                cssDir: '<%= config.tmp %>/assets/css',
                imagesDir: '<%= config.src %>/assets/images',
                javascriptsDir: '<%= config.src %>/assets/js',
                fontsDir: '<%= config.src %>/assets/fonts',
                importPath: '<%= config.src %>/bower_components',
                httpImagesPath: '/assets/images',
                httpGeneratedImagesPath: '/assets/images/generated',
                httpFontsPath: '/assets/css/fonts',
                relativeAssets: false,
                assetCacheBuster: false
            },
            dist: {
                options: {
                    cssDir: '<%= config.tmp %>/assets/css',
                }
            },
        },


        /*********************************
        *  Remove comments from min css
        *********************************/
        cssmin: {
            options: {
                keepSpecialComments: 0
            }
        },


        /*********************************
        *   SVG Minify
        *********************************/
        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= config.src %>/assets/decorations',
                    src: [
                        '{,*/}*.svg',
                        '!{,*/}{curtain.svg,zig-zag.svg,zipper.svg}'
                    ],
                    dest: '<%= config.dist %>/assets/decorations'
                }]
            }
        },

        /*********************************
        *   HTML Prettyfy .prettifyrc for details
        *********************************/
        prettify: {
            options: {
                config: '.prettifyrc'
            },
            // Prettify a directory of files
            all: {
                expand: true,
                cwd: '<%= config.tmp %>',
                ext: '.html',
                src: ['*.html'],
                dest: '<%= config.dist %>'
            },
        },

        /*********************************
        *   JSHint - check everything ok js wise
        *********************************/
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                reporter: require('jshint-stylish')
            },
            all: [
                'Gruntfile.js',
                '<%= config.src %>/assets/js/{,*/}*.js'
            ]
        },

        /*********************************
        * Usemin concat & minify js/css
        *********************************/
        useminPrepare: {
            html: '<%= config.tmp %>/index.html',
            options: {
                dest: '<%= config.dist %>'
            }
        },

        usemin: {
            options: {
                assetsDirs: ['<%= config.tmp %>']
            },
            html: ['<%= config.tmp %>/{,*/}*.html'],
            css: ['<%= config.tmp %>/assets/css/{,*/}*.css']
        },

        /*********************************
        * HTML Validator
        *********************************/
        validation: {
            options: {
                reset: grunt.option('reset') || false,
                stoponerror: true,
                // relaxerror: ['Bad value X-UA-Compatible for attribute http-equiv on element meta.'] //ignores these errors
            },
            files: {
                src: ['<%= config.dist %>/*.html']
            },

        },

        /*********************************
        * Copy file tasks
        *********************************/
        copy: {
            // moves all script files needed for build into .tmp folder
            tmp: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= config.src %>',
                    dest: '<%= config.tmp %>',
                    src: [
                        'assets/**/*.*',
                        'bower_components/**/*.*',
                        'images/**/*'
                    ]
                }]
            },
            dist: {
                files: [{
                    // theme mixins needed for php building scss
                    expand: true,
                    dot: true,
                    cwd: '<%= config.src %>/assets/',
                    dest: '<%= config.dist %>/assets/',
                    src: [
                        'fonts/*',
                        'images/**/*'
                    ]
                }]
            }
        },

        /*********************************
        * Create Fav Icons
        *********************************/
        favicons: {
            options: {
                trueColor: true,
                precomposed: true,
                appleTouchPadding: 0,
                tileBlackWhite: false,
                windowsTile: false,
                tileColor: 'none',
            },
            icons: {
                src: '<%= config.src %>/assets/images/favicon.png',
                dest: '<%= config.dist %>/assets/images/favicons'
            }
        },

        // Before generating any new files,
        // remove any previously-created files.
        clean: [
            '<%= config.dist %>',
            '<%= config.tmp %>'
        ]
    });

    grunt.registerTask('server', [
        'clean',
        'assemble',
        'copy:tmp',
        'compass',
        'connect:livereload',
        'watch'
    ]);

    grunt.registerTask('build', [
        'clean',
        'assemble',
        'copy',
        'compass',
        'useminPrepare',
        'concat',
        'cssmin',
        'uglify',
        'svgmin',
        'usemin',
        'prettify',
        'favicons'
    ]);

    grunt.registerTask('default', [
        'build'
    ]);

};
