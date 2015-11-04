---
  title: Elements
  subtitle: Guide to Angular Material Elements
  layout: docs.hbs
  section: triangular
---

# Introduction

{{theme.name}} uses [Angular Translate](https://angular-translate.github.io/) to translate strings in the template.

Angular tranlsate has [great documentation](http://angular-translate.github.io/docs/#/guide) as well as an [API guide](http://angular-translate.github.io/docs/#/api).

# How to translate a page

In order to translate some text in a page just use the tranlsate directive in your HTML.

for example

    <h1 translate>HELLO</h1>

Then edit the en.json file located in your module/app il8n folder and add the following json.

    {
        "HELLO": "Hello World"
    }

You will then see that your HELLO placeholder is translated into Hello world.

# How to translate a menu item

Each menu item is filtered with the translate filter.  So just make sure that the placeholder string you use for your menu is translated in your il8n json files.

For example in <code>app/introduction/introduction.module.js</code> you will find the following code.

    triMenuProvider.addMenu({
        name: 'MENU.INTRODUCTION.INTRODUCTION',
        state: 'admin-panel.default.introduction',
        type: 'link',
        icon: 'icon-info-outline',
        priority: 1.1
    });

The name of this menu is being set to the placeholder <code>MENU.INTRODUCTION.INTRODUCTION</code> so if we have a translation in our il8n folder that looks like this.

    {
        "MENU": {
            "INTRODUCTION": {
                "INTRODUCTION" : "Introduction"
            }
        }
    }

Then the menu item will use "Introduction" for its label.

# Auto translating all theme strings

We have built in an auto translater into triangular that sends all the strings in your il8n folders to Yandex to be translated.

It then writes translation files in your chosen language.

First of all to use this you will need to [get a Yandex API Key](https://tech.yandex.com/translate/).

Once you have a key edit this file

    app/gulp/translate.js

At the top of the file you will see this code


    // ADD YOUR YANDEX API KEY HERE
    // go here for more info
    // https://tech.yandex.com/translate/
    var YANDEX_API_KEY = '';

edit the YANDEX_API_KEY and add your api key

    var YANDEX_API_KEY = '1234567894621695846516546951651981';

Once this is done, open up a terminal and cd to your app directory.

From there you can run the gulp task that will translate the template translation files.

You need to specify 2 lanuages e.g.

    gulp translate --from en --to fr

The command above will grab all en.json files from all your il8n folders send them to Yandex to be translated into French.

Once this is done the resulting translations will be written to fr.json files in each coresponding il8n folder.
