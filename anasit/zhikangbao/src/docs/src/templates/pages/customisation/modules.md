---
  title: Modules
  subtitle: How to change remove and create angular modules for triangular
  layout: docs.hbs
  section: customisation
---

# Modules loaded by triangular

The very first lines of javascript that run in app.module.js create the triangular app and tell angular which modules it will need to load.

    (function() {
      'use strict';

      angular
          .module('app', [
              'triangular',
              'ngAnimate', 'ngCookies', 'ngTouch', 'ngSanitize', 'ngMessages', 'ngMaterial',
              'ui.router', 'pascalprecht.translate', 'LocalStorageModule', 'googlechart', 'chart.js', 'linkify', 'ui.calendar', 'angularMoment', 'textAngular', 'uiGmapgoogle-maps', 'hljs', 'md.data.table',
              // 'seed-module'
              // uncomment above to activate the example seed module
              'app.examples'
          ])
    })();

### Angular Modules

Triangular loads the following angular modules

- **ngAnimate** - Provides support for CSS-based animations.
- **ngCookies** - Provides a convenient wrapper for reading and writing browser cookies.
- **ngTouch** - Provides touch events and other helpers for touch-enabled devices.
- **ngSanitize** - Provides functionality to sanitize HTML.
- **ngMessages** - Provides enhanced support for displaying messages within templates.
- **ngMaterial** - The [Angular Material project](https://material.angularjs.org/) is an implementation of Material Design in Angular.js

### 3rd Party Modules

Triangular loads the following 3rd party angular modules

- **ui.router** - The de-facto solution to flexible routing with nested views in AngularJS [Site](http://angular-ui.github.io/ui-router/site/)
- **pascalprecht.translate** - i18n in your Angular apps, made easy [Site](https://angular-translate.github.io/)
- **LocalStorageModule** - Stores selected language in local storage
- **googlechart** - Google Chart Tools AngularJS Directive Module [Site](http://angular-google-chart.github.io/angular-google-chart)
- **chart.js** - Reactive, responsive, beautiful charts for AngularJS using Chart.js [Site](http://jtblin.github.io/angular-chart.js)
- **linkify** - Angular filter, directive, and service to linkify text. [Site](https://github.com/scottcorgan/angular-linkify)
- **ui.calendar** - A complete AngularJS directive for the Arshaw FullCalendar. [Site](http://angular-ui.github.io/ui-calendar/)
- **angularMoment** - Moment.JS directives for Angular.JS (timeago and more). [Site](https://github.com/urish/angular-moment)
- **textAngular** - A radically powerful Text-Editor/Wysiwyg editor for Angular.js! [Site](https://github.com/fraywing/textAngular)
- **uiGmapgoogle-maps** - AngularJS directives for the Google Maps Javascript API. [Site](https://github.com/angular-ui/angular-google-maps)
- **hljs** - AngularJS directive for syntax highlighting with highlight.js. [Site](https://github.com/pc035860/angular-highlightjs)

### App Modules

- **triangular** - The triangular core module located in the triangular/ folder
- **app.examples** - All the example modules that you see in the demo site

# Module structure

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

# Removing a module

Removing a module is super easy just edit the dependencies loaded in app/examples/examples.module.js

    (function() {
        'use strict';

        angular
            .module('app.examples', [
                'app.examples.authentication',
                'app.examples.calendar',
                'app.examples.charts',
                'app.examples.dashboards',
                'app.examples.elements',
                'app.examples.email',
                'app.examples.extras',
                'app.examples.forms',
                'app.examples.github',
                'app.examples.introduction',
                'app.examples.layouts',
                'app.examples.maps',
                'app.examples.menulevels',
                'app.examples.todo',
                'app.examples.ui'
            ]);
    })();


For example if you wanted to remove the authentication pages (login, forgot password, etc) you would want to remove the triangular authentication package.

So you would remove this nine

    'app.examples.authentication',

This will stop the example authentication module in the authentication folder from being loaded and remove the menu and pages.


# Creating a module

In order to make creating a module for your work as easy as possible we have created a simple seed module to get started.

You can find the code in <code>app/seed-module</code>

To create your own module just make a copy of this folder and rename it to your new module name.

After that rename the module to your new module name and then add it to the dependencies in app.module.js
