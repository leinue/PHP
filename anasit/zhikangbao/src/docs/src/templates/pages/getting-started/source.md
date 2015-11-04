---
  title: Source folder
  subtitle: How to get started setting up the build found in the source folder
  layout: docs.hbs
  section: getting-started
---

# The source files

## Introduction

Once you have [downloaded and unzipped](download.html) the main template download zip.

You will find several folders have been created, one of which will be a folder called source.

This is where you will find the main [gulp](http://gulpjs.com/) build and angularjs source files.

## Gulp Angular build system

The gulp build system was generated using the [Yeoman Gulp Angular](https://github.com/Swiip/generator-gulp-angular) generator.

Generator offers a great start to creating any AngularJS app becuas it incudes the following:

- useref : allow configuration of your files in comments of your HTML file
- ngAnnotate : convert simple injection to complete syntax to be minification proof
- uglify : optimize all your JavaScript
- csso : optimize all your CSS
- rev : add a hash in the file names to prevent browser cache problems
- watch : watch your source files and recompile them automatically
- jshint : JavaScript code linter
- Unit test (karma) : out of the box unit test configuration with karma
- e2e test (protractor) : out of the box e2e test configuration with protractor
- browser sync : full-featured development web server with livereload and devices sync
- angular-templatecache : all HTML partials will be converted to JS to be bundled in the application

The generator was also built using the [Best Practice Recommendations for Angular App Structure](https://docs.google.com/document/d/1XXMvReO8-Awi1EZXAXS4PzDzdNvV6pGcuaF4Q9821Es/pub)

## Folder and File structure

Inside the source folder you will see a folder structure like this:

|   Folder / File    |                             Contents                             |
| ------------------ | :--------------------------------------------------------------- |
| .bowerrc           | Sets folder to install bower components                          |
| .editorconfig      | Sets editor coding standards                                     |
| .jshintrc          | Sets jshint configuration                                        |
| .yo-rc.json        | Yeoman config                                                    |
| bower.json         | Lists all packages to be installed by bower                      |
| gulpfile.js        | Main gulp file                                                   |
| karma.conf.js      | Karma unit test config                                           |
| package.json       | Lists all packages to be installed by node package manager (npm) |
| protractor.conf.js | Protractor end to end config                                     |
| e2e/               | Protractor end to end test folder                                |
| gulp/              | Contains gulp build source files                                 |
| src/               | Contains the triangular app code (JS/SASS/HTML/ETC)              |
| test/              | Karma unit test folder                                           |

Inside the source folder you will find the following folders and files

| Folder / File |                  Contents                  |
| ------------- | :----------------------------------------- |
| app/          | Contains the main app files                |
| assets/       | Contains app image files                   |
| 404.tmpl.html | 404 page html                              |
| 500.tmpl.html | 500 page html                              |
| favicon.png   | Favourite icon                             |
| index.html    | Main index html file                       |

Inside the app folder you will find the following files and folders

|         Folder / File         |                       Contents                       |
| ----------------------------- | :--------------------------------------------------- |
| examples/                     | Includes all the example pages used in the app       |
| il8n/                         | Contains app translation files                       |
| seed-module                   | Contans an example module to use in your own app     |
| triangular/                   | The main triangular module                           |
| app.module.js                 | The main app module file                             |
| app.scss                      | The main app scss file                               |
| config.chartjs.js             | Config to make chartjs plugin use MD colors          |
| config.route.js               | Config to set up your app routes                     |
| config.translate.js           | Config to set your app languages                     |
| config.triangular.layout.js   | Config to set triangulars default page layouts       |
| config.triangular.settings.js | Config to set triangulars default settings           |
| config.triangular.themes.js   | Config to set up triangulars theme colors and themes |
| value.googlechart.js          | Adds a value used by google charts plugin            |

## Module structure

Each module in {{theme.name}} uses John Papa's recommended structure and naming conventions.

To find out how this structure works we will describe one of the more simple modules below, the introduction module.

This module justs adds one menu item and one page to the site.

|       Folder / File        |                         Contents                        |
| -------------------------- | :------------------------------------------------------ |
| il8n/                      | Translation json files                                  |
| introduction.config.js     | Sets up the modules routes and adds menus to triangular |
| introduction.controller.js | Controller for the introduction.tmpl.html page          |
| introduction.module.js     | Module js file                                          |
| introduction.tmpl.html     | Introduction page HTML                                  |
| introduction.tmpl.scss     | Introduction page SCSS for CSS styling                  |


# Setting up Gulp

In order you run the gulp build system for the template you will need to install node.js on your system.

Follow the instructions below to install node.js on your system.

## Installing Node.js

We recommend installing the latest version of node.  At the time of writing this was (0.12.6).

You can download the latest of node.js [from here](https://nodejs.org/download/) alternatively there are [guides on how to install using a package manager](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager).

## Checking node is installed and working

Once you have node.js installed on your system you should be able to go to your command line and type

    npm --version

and see something like this

    $ npm --version
    2.11.3


## Getting the build system ready

In order to finish the set up of the build system you just need to run 2 simple commands from the root directory of your unzipped source files.

## Install node modules

Run the following command from the root of your source files to install the node modules listed in packages.json

    npm install

## Install bower packages

If you do not have bower installed run

    npm -g install bower

<div class="alert alert-info" role="alert">
  <strong>Note</strong> - You will need git installed for bower to work <a href="https://git-scm.com/">Git website</a>
</div>

Run the following command from the root of your source files to install the bower packages listed in bower.json

    bower install

# Running a development server

Once you have gulp all ready to go you can start developing.

To do this you just need to start a local development server

## Start a development server

First make sure you have gulp installed globally

  npm -g install gulp

Once you have bower packages and node modules installed you are ready to code.  To start a development server just type.

    gulp serve

This should automatically open up a browser window with the template running.

## Browsersync

Once the development server is up and running any changes you make to the HTML & JS & SASS files will be auto updated in your browser window.

# Creating a production build

## Running a production server

Before you run a production build you can test your production files first by running a local production server.

Just run the command

    gulp serve:dist

The local server that runs will now be running a built version of your site.

## Running a production build

Once you are happy with your site you can initiate a build that will create a copy of the template that you can FTP to your web server.

Just run the command

    gulp build

This will initiate a build, once it has finished you will find your built files in a folder called dist that will have been created for you.

