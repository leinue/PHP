---
  title: CSS
  subtitle: Guide to the CSS used in triangular
  layout: docs.hbs
  section: triangular
---

# Introduction

The CSS for {{theme.name}} is generated [using Sass ](http://sass-lang.com/).

You can find the Sass code in the following places

|          Folder / File          |                        Contents                       |
| ------------------------------- | :---------------------------------------------------- |
| src/app.scss                    | The main app sass file                                |
| src/triangular/_triangular.scss | Contains all the css needed for the triangular module |

<div class="alert alert-info" role="alert">
    **Note** - The gulp build will automatically compile any scss files added to the src folder or subfolders.  The resulting CSS will be minified and added to the app.css file.
</div>

Also each module imports its own scss files.

For example the elements module has its own scss file here.

    app/examples/elements/elements.module.scss

# Flexible Box Model

{{theme.name}} & Angular Material use the flexible box model to layout elements on the page.

You can read all about how the flex box model is implemented in the layout section of the [Angular Material Docs](https://material.angularjs.org).

# Helper Classes

We have provided some helper CSS classes to help easily create pages.

## Page helpers

|            CSS Class             |                     Description                      |
| -------------------------------- | :--------------------------------------------------- |
| <code>full-height</code>         | Makes a container use the full height of its parent. |
| <code>full-width</code>          | Makes a container use the full width of its parent.  |
| <code>padded-content-page</code> | Adds default padding to a page                       |

## Margin helpers

|                      CSS Class                       |                                    Description                                     |
| ---------------------------------------------------- | :--------------------------------------------------------------------------------- |
| <code>margin-normal</code>                           | Adds the default 16px margin to all sides.                                         |
| <code>margin-(0-200 in steps of 10)</code>           | Adds a margin all around the element, in steps of 10. e.g. margin-10               |
| <code>margin-(top/bottom/left/right)-(0-200)</code>  | Adds a margin to a specific side of an element, in steps of 10. e.g. margin-top-50 |

## Padding helpers

|                      CSS Class                       |                                    Description                                     |
| ---------------------------------------------------- | :--------------------------------------------------------------------------------- |
| <code>padding-normal</code>                          | Adds the default 16px padding to all sides.                                        |
| <code>padding-(0-200)</code>                         | Adds padding all around the element, in steps of 10. e.g. padding-100              |
| <code>padding-(top/bottom/left/right)-(0-200)</code> | Adds padding to a specific side of an element, in steps of 10. e.g. padding-top-70 |

## Display helpers

|          CSS Class           |                   Description                    |
| ---------------------------- | :----------------------------------------------- |
| <code>opacity-(0-100)</code> | Sets the opacity of the element. e.g. opacity-50 |
| <code>make-round</code>      | Adds 50% border radius                           |
| <code>overlay-(0-100)</code> | Adds dark overlay to container                   |


# CSS autoprefixer

The gulp automatically adds browser prefixes to your CSS using [gulp-autoprefixer](https://github.com/sindresorhus/gulp-autoprefixer).

To configure this just edit

    app/gulp/styles.js

You can select which browsers you want to have compatibility with on this line.

    .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1']}))

By default triangular is compatible with the last 2 versions of evergreen browsers as well as Firefox ESR and Opera 12.1
