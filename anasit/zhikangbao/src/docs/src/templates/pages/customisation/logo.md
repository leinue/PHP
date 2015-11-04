---
  title: Logo & Name
  subtitle: How to change the template logo and name
  layout: docs.hbs
  section: customisation
---

# Changing the logo

The super easy way to change the template logo is to replace this file.

    src/assets/images/logo.png

With your own logo.  This will replace the logo used througout the theme (Logo above sidebar, loading animations, etc)

<div class="alert alert-info" role="alert">
    Note - Use the same image size as the template for the best results.
</div>

If you want to change the image filename used for the template logo edit the following line in config.triangular.settings.js

    triSettingsProvider.setLogo('assets/images/logo.png');

# Changing the template name

To change the name that is shown in the logo bar at the top of the sidemenu & loading animation just edit the following line in config.triangular.settings.js

    triSettingsProvider.setName('triangular');

# Changing the template version

To change the version number that is shown in the footer just edit the following line in config.triangular.settings.js

    triSettingsProvider.setVersion('2.0');
