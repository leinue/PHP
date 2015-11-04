---
  title: Download Contents
  subtitle: How to download the template zip and what is inside
  layout: docs.hbs
  section: getting-started
---

# Downloading the template zip

First of all you will need to log in to your themeforest account.

After that goto your downloads page
![ThemeForest Downloads Page](assets/images/getting-started/tf-download.png)

From there locate the {{theme.name}} template click the **download button** and then select **All files & documentation**
![ThemeForest Downloads Page](assets/images/getting-started/tf-downloads.png)

<div class="alert alert-info" role="alert">
  Congratulations.  You now have a shiny new copy of {{theme.name}}
</div>

# Unzipping the download

You should now have a file that looks something like this.

<code>triangular-1.0.0.zip</code>

In order to get at the goodness inside you will need to [unzip this file](https://answers.stanford.edu/solution/how-do-i-zip-and-unzip-files-and-folders-do-i-need-winzip-or-stuffit).

# Zip Contents

Once you have unzipped the {{theme.name}} zip file you will find the following folders have been created.

| Folder / File |                    Contents                   |
| ------------- | :-------------------------------------------- |
| changelog.md  | lists changes to each version of the template |
| source/       | contains the templates source files           |
| demo/         | compiled version of source files              |
| docs/         | the documentation you are reading now         |
| extras/       | lots of extra material design goodies         |

The source folder contatins the gulp build system and all the templates source files.  You can read more about how to set this up in the Getting Started -> Source section of the docs.

The demo folder contains a built version of the source files, this is an exact copy of the demo site that is running on {{theme.name}}'s ThemeForest demo site.

The docs folder contains a copy of the latest documentation for {{theme.name}}, there is also an online copy available.

The extras folder contains lots of material design graphics and a copy of the {{theme.name}} PHP API that provides the dummy content for the demo.