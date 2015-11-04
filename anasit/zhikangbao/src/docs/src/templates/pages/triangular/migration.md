---
  title: Migration from 1.0 to 2.0
  subtitle: Guide to migration from version 1.0 to 2.0
  layout: docs.hbs
  section: triangular
---

# Changes in 2.0

The main changes for version 2.0 were as follows

- Code style changes to match [John Papas style guide](https://github.com/johnpapa/angular-styleguide)
- Move triangular into it's own module to allow better intergration with new & existing apps
- Moved from jshint to eslint with eslint-angular plugin
- Changed the names of triangular routes and simplified creating pages
- Changed menu provider
- Added profiler to test speed of your AngularJS code

We realise that these changes will involve some refactoring of existing projects, but as this template is relatively new at the moment we felt this was the best time to refactor.

Moving on this will make the triangular template a lot easier to intergrate with apps and provide a more robust coding standard.

# Code style changes

These changes should not effect your app in any way other than to make the code even more readable and easier to debug.  Please read [John Papas style guide](https://github.com/johnpapa/angular-styleguide) to get an idea of the style.

# Module Folder Changes

Triangular's code has now been moved into it's own module called 'triangular'

<div class="row">
    <div class="col-md-5">
        <h4>Old folder structure</h4>
        <img src="assets/images/triangular/migration-old-folders.png" alt="Old Folder Structure">
    </div>
    <div class="col-md-2">

    </div>
    <div class="col-md-5">
        <h4>New folder structure</h4>
        <img src="assets/images/triangular/migration-new-folders.png" alt="Old Folder Structure">
    </div>
</div>

## Folder changes

| Old Folder / File |                    New Folder / File                    |
| ----------------- | :------------------------------------------------------ |
| authentication/   | examples/authentication/                                |
| calendar/         | examples/calendar/                                      |
| charts/           | examples/charts/                                        |
| dashboards/       | examples/dashboards/                                    |
| elements/         | examples/elements/                                      |
| forms/            | examples/forms/                                         |
| github/           | examples/github/                                        |
| introduction/     | examples/introduction/                                  |
| layouts/          | triangular/layouts/                                     |
| maps/             | examples/maps/                                          |
| menulevels/       | examples/menulevels/                                    |
| seed-module/      | seed-module/                                            |
| themeing/         | triangular/themes/                                      |
| todo/             | examples/todo/                                          |
| ui/               | examples/ui/                                            |
| app.js            | split into config.*.js files                            |
| app.scss          | app.scss which imports triangular/_triangular.scss file |
| assets/           | (no change)                                             |
| 404.tmpl.html     | (no change)                                             |
| 500.tmpl.html     | (no change)                                             |
| favicon.png       | (no change)                                             |
| index.html        | (no change)                                             |

# Module Config Changes

The main changes that will effect your existing modules will be the changes to the module config.  Mainly the renaming of the UI Router abstract states and the refactoring of the menu provider.

To move modules over to Triangular 2.0 you will need to change 2 things

- Route names
- Side menu setup

The code is very similar to triangular 1.0 so it should be easy to transition modules over see our [Full Example](#full-example) for more detail

## UI Router name changes

We have renamed some of the routes in triangular as follows

|       Old Route       |             New Route              |
| --------------------- | :--------------------------------- |
| admin-panel.default   | triangular.admin-default           |
| admin-panel-no-scroll | triangular.admin-default-no-scroll |


## Example Route

Old Route Config

    .state('admin-panel.default.maps-demos', {
        url: '/maps/demos',
        templateUrl: 'app/maps/maps-demo.tmpl.html',
    });

New Route Config

    .state('triangular.admin-default.maps-demos', {
        url: '/maps/demos',
        templateUrl: 'app/examples/maps/maps-demo.tmpl.html'
    });

## Menu Provider

Angular 2.0 uses the a new provider to add menu items to your side menu and you no longer have to create your menus in a module .run function.

Previous setup

    .run(function(SideMenu) {
        SideMenu.addMenu({
            name: 'MENU.MAPS.MAPS',
            icon: 'icon-place',
            type: 'dropdown',
            priority: 7.1,
            children: [{
                name: 'MENU.MAPS.FULLWIDTH',
                state: 'admin-panel.default.maps-fullwidth',
                type: 'link',
            },{
                name: 'MENU.MAPS.DEMOS',
                state: 'admin-panel.default.maps-demos',
                type: 'link',
            }]
        });
    });

New Setup (in a module .config not .run)

    .config(function(triMenuProvider) {
        triMenuProvider.addMenu({
            name: 'MENU.MAPS.MAPS',
            icon: 'icon-place',
            type: 'dropdown',
            priority: 7.1,
            children: [{
                name: 'MENU.MAPS.FULLWIDTH',
                state: 'triangular.admin-default.maps-fullwidth',
                type: 'link'
            },{
                name: 'MENU.MAPS.DEMOS',
                state: 'triangular.admin-default.maps-demos',
                type: 'link'
            }]
        });
    });


## Full Example

Here is an example of how the routing and menus have changed

Old config

    'use strict';

    /**
     * @ngdoc module
     * @name triAngularMaps
     * @description
     *
     * The triAngularMaps module adds some map example pages
     */
    angular.module('triAngularMaps', [])
    .config(function ($translatePartialLoaderProvider, $stateProvider, uiGmapGoogleMapApiProvider) {
        $translatePartialLoaderProvider.addPart('app/maps');

        $stateProvider
        .state('admin-panel.default.maps-fullwidth', {
            url: '/maps/fullwidth',
            templateUrl: 'app/maps/maps-fullwidth.tmpl.html',
            controller: 'MapController'
        })
        .state('admin-panel.default.maps-demos', {
            url: '/maps/demos',
            templateUrl: 'app/maps/maps-demo.tmpl.html',
        });

        uiGmapGoogleMapApiProvider.configure({
            v: '3.17',
            libraries: 'weather,geometry,visualization'
        });
    })
    .run(function(SideMenu) {
        SideMenu.addMenu({
            name: 'MENU.MAPS.MAPS',
            icon: 'icon-place',
            type: 'dropdown',
            priority: 7.1,
            children: [{
                name: 'MENU.MAPS.FULLWIDTH',
                state: 'admin-panel.default.maps-fullwidth',
                type: 'link',
            },{
                name: 'MENU.MAPS.DEMOS',
                state: 'admin-panel.default.maps-demos',
                type: 'link',
            }]
        });
    });



New Config

    (function() {
        'use strict';

        angular
            .module('app.examples.maps')
            .config(moduleConfig);

        /* @ngInject */
        function moduleConfig($translatePartialLoaderProvider, $stateProvider, uiGmapGoogleMapApiProvider, triMenuProvider) {
            $translatePartialLoaderProvider.addPart('app/examples/maps');

            $stateProvider
            .state('triangular.admin-default.maps-fullwidth', {
                url: '/maps/fullwidth',
                templateUrl: 'app/examples/maps/maps-fullwidth.tmpl.html',
                controller: 'MapController',
                controllerAs: 'vm'
            })
            .state('triangular.admin-default.maps-demos', {
                url: '/maps/demos',
                templateUrl: 'app/examples/maps/maps-demo.tmpl.html'
            });

            uiGmapGoogleMapApiProvider.configure({
                v: '3.17',
                libraries: 'weather,geometry,visualization'
            });

            triMenuProvider.addMenu({
                name: 'MENU.MAPS.MAPS',
                icon: 'icon-place',
                type: 'dropdown',
                priority: 7.1,
                children: [{
                    name: 'MENU.MAPS.FULLWIDTH',
                    state: 'triangular.admin-default.maps-fullwidth',
                    type: 'link'
                },{
                    name: 'MENU.MAPS.DEMOS',
                    state: 'triangular.admin-default.maps-demos',
                    type: 'link'
                }]
            });
        }
    })();