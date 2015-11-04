---
  title: Typography
  subtitle: How to change the typography of the admin template
  layout: docs.hbs
  section: customisation
---

# Previewing available fonts

{{theme.name}} comes with some pre defined fonts that you can try out.

Goto the demo site to [take a look](http://triangular.oxygenna.com/#/ui/typography).

# Changing the font

Changing the font that is used by triangular is very easy.

First of all choose a font from [Google Fonts](http://www.google.com/fonts) (we reccommend using a font with 300,400,500 and 700 weights available).

Once you have a font you would like to use edit <code>index.html</code> and edit the contents of the head tag.

You will see a section of code like this.

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=RobotoDraft:300,400,500,700,400italic">

Google Fonts wil tell you the correct code to replace this with when you choose to use a font from the [Google Fonts Site](http://www.google.com/fonts).

Once you have replaced this link tag with the one suggested by Google Fonts, edit the <code>/app/src/app.scss</code> file and change the following line to use your new font family.

    button, select, html, textarea, input {
      font-family: RobotoDraft, Roboto, 'Helvetica Neue', sans-serif;
    }
