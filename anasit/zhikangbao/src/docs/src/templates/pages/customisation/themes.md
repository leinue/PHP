---
  title: Colors & Skins
  subtitle: How to change the admin template colors.
  layout: docs.hbs
  section: customisation
---

# Introduction

Angular Material already comes with a system for handling themes and palettes.

You can [read about them here ](https://material.angularjs.org/HEAD/#/Theming/01_introduction)

With triangular we created 2 extra providers for handling themes and skins.

|      Provider      |                                                                                                                    Description                                                                                                                    |
| ------------------ | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| triThemingProvider | Copys exactly the functionality provided by the [mdThemingProvider](https://material.angularjs.org/HEAD/#/Theming/03_configuring_a_theme) but allows us to dynamically load themes which saves on the amount of extra CSS created by the template |
| triSkinsProvider   | Allows you to create skins for triangular and assign themes to various areas of the template (toolbar, logo, content, sidebar)                                                                                                                    |

# Set the default skin

{{theme.name}} comes with many beautiful themes.

You can [view and try them all here](http://triangular.oxygenna.com/#/ui/skins).

To change the default skin is super easy.

Just edit config.triangular.themes.js and change this line to a skin you would like to load.

    defaultSkin: 'cyan-cloud'

Change this to any of the provided skin names

- cyan-cloud
- red-dwarf
- plumb-purple
- dark-knight
- battleship-grey
- zesty-orange
- indigo-island
- kermit-green

For example to change to the Plumb Purple theme you would change to.

    defaultSkin: 'plumb-purple'

# Create your own template skin

To change the colors that are used in triangular edit <code>config.triangular.themes.js</code>

[You can see on the skins page](http://triangular.oxygenna.com/#/ui/skins) how the template can be colored.

There are 4 areas of the template that you can set "themes" for.

- Sidebar - the main left menu sidebar.
- Toolbar - the top toolbar of the page.
- Logo - the logo at the top of the Sidebar (top left of the page).
- Content - the content area where your pages are shown.

## Create some themes

First of all you will need to create some themes to use to color the template areas.

You can do this using the <code>triThemingProvider</code> to assign palettes.

Material Angular comes with several material design palettes built in.  You can view the [palettes available here](http://triangular.oxygenna.com/#/ui/colors).

    triThemingProvider.theme('cyan')
    .primaryPalette('cyan')
    .accentPalette('amber')
    .warnPalette('deep-orange');

The line above creates a theme called "cyan" which sets the primary palette to cyan and the accent and warn palettes to amber and deep-orange.

Next we can make a 2nd theme to go with the cyan theme.

    triThemingProvider.theme('white-cyan')
    .primaryPalette('white')
    .accentPalette('cyan', {
      'default': '500'
    })
    .warnPalette('deep-orange');

This theme has white as its primary palette and cyan as its accent palette.

## Create a skin

Now that we have some themes to play with we can assign them to the areas of the template.

We can do this using the <code>triSkinsProvider</code>.

    triSkinsProvider.skin('cyan-cloud', 'Cyan Cloud')
    .sidebarTheme('cyan')
    .toolbarTheme('white-cyan')
    .logoTheme('cyan')
    .contentTheme('cyan');

![Cyan Skin](assets/images/customisation/skin-preview.png)

So above we have created a theme called Cyan Cloud that uses the two themes we created in the previous steps.

The sidebar and logo are using cyan and the toolbar and content areas are using white-cyan

You will find a config block that handles how the default themes are used for the various themable elements used in the template.

    // set the default themes for each of the themeable elements
    triThemeProvider.setThemeableElements({
        mainTheme: 'default',
        logoTheme: 'default',
        toolbarTheme: 'default',
        sidebarTheme: 'default'
    });

As you can see all the themable elements are set to use the default theme.  If you want to change this just edit the property with the element name you want to change and modify it to use a valid theme name.

For example to change the sidebar to use a theme called "Green" you would do the following.

    // set the default themes for each of the themeable elements
    triThemeProvider.setThemeableElements({
        mainTheme: 'default',
        logoTheme: 'default',
        toolbarTheme: 'Green',
        sidebarTheme: 'default'
    });

From now the template will use the Green theme to color the sidebar.

You can find more information about the themes available on the [themes page of the demo site](http://triangular.oxygenna.com/#/ui/themes).

Or to create your own themes read the next section.

# Disable demo skin selection

By default the template allows users to select a skin that is then stored in a cookie.

If you want to disable this just edit config.triangular.themes.js and remove the following line.

    triSkinsProvider.useSkinCookie(true);

# Creating your own palettes

If you don't want to use the palettes provided by material design, you can also create your own.  Just add a config function that injects the <code>$mdThemeingProvide</code> and define the colors you want to use.

    (function() {
        'use strict';

        angular
            .module('app')
            .config(themesConfig);

        /* @ngInject */
        function themesConfig ($mdThemingProvider) {
            $mdThemingProvider.definePalette('amazingPaletteName', {
                '50': 'ffebee',
                '100': 'ffcdd2',
                '200': 'ef9a9a',
                '300': 'e57373',
                '400': 'ef5350',
                '500': 'f44336',
                '600': 'e53935',
                '700': 'd32f2f',
                '800': 'c62828',
                '900': 'b71c1c',
                'A100': 'ff8a80',
                'A200': 'ff5252',
                'A400': 'ff1744',
                'A700': 'd50000',
                'contrastDefaultColor': 'light',    // whether, by default, text (contrast)
                                                    // on this palette should be dark or light
                'contrastDarkColors': ['50', '100', //hues which contrast should be 'dark' by default
                 '200', '300', '400', 'A100'],
                'contrastLightColors': undefined    // could also specify this if default was 'dark'
            });
            $mdThemingProvider.theme('default')
            .primaryPalette('amazingPaletteName');
        }
    });
