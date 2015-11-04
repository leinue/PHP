---
  title: Elements
  subtitle: Guide to triangular directives
  layout: docs.hbs
  section: triangular
---

# Background Color

## paletteBackground

This directive sets the background and contrast text color of an element to a [palette hue](http://triangular.oxygenna.com/#/ui/colors).

![Color Hue](assets/images/triangular/color-hue.png)

For example to color a div using the blue 500 hue you would just use the following HTML

    <div palette-background="blue:500">
        Look ma the divs blue 500!
    </div>

## themeBackground

This directive sets the background and contrast text color of an element to a [theme hue](http://triangular.oxygenna.com/#/ui/colors).

For example to color a div using the cyan themes accent hue-1 color you would just use the following HTML

    <div md-theme="cyan" theme-background="accent:hue-1">
        Look ma the divs cyan accent hue-1!
    </div>

# Widgets

## Widget

To create a widget to be used in a dashboard we have created a directive.

    <widget title="'Nice Title'" subtitle="'Subtitle'" title-position="top|bottom|left|right" content-padding overlay-title>content here</widget>

The following widget options are available.

- title: sets the title of the widget
- subtitle: sets the subtitle of the widget
- title-position: top|bottom|left|right
- content-padding: adds padding to the widget content
- content-layout: adds layout to the widget content e.g. content-layout="center center"
- overlay-title: makes the title lie over the widget content
- background-image: adds a background image to the widget

You can see all the widgets in action and how the code works in the dashboards module.

## countupto

This directive is used in the analytics dashboard widgets to trigger a counting animation.

For example to animate a counter from 0 to 101 with no decimals you would use the following.

    <p countupto="101" decimals="0"></p>

Available options can be sent to the directive using an options attribute.

Full list of options are [listed here](http://inorganik.github.io/countUp.js/).