# Valentinus Twenty Twenty One
A WordPress child theme for the Twenty Twenty-One theme. Made to explore and hack the Twenty Twenty One theme.

![Screenshot](https://raw.githubusercontent.com/jooplaan/twentytwentyone-valentinus/main/screenshot.png)

## Added features

* Add support for header image ([v1.4](https://github.com/jooplaan/twentytwentyone-valentinus/releases/tag/v.1.4))
* Add widget for related posts ([v1.3](https://github.com/jooplaan/twentytwentyone-valentinus/releases/tag/v.1.3))
* Add template to use with sidebar ([v1.2](https://github.com/jooplaan/twentytwentyone-valentinus/releases/tag/v.1.2))
* Optional right sidebar with widget area ([v1.1.1](https://github.com/jooplaan/twentytwentyone-valentinus/releases/tag/v1.1.1))
* Custom Block pattern example ([v1.0](https://github.com/jooplaan/twentytwentyone-valentinus/releases/tag/v1.0))

## How to use this

### Fresh install using zip file
Simplest way to get started with this child theme:

* [Download the latest version](https://github.com/jooplaan/twentytwentyone-valentinus/releases/latest)
* Unzip or untar the dowloaded archive
* Put the folder to your theme folder of your install
* Activate the Valentinus Twenty Twenty One child theme in the WordPress admin
* Hack it to your liking

### Or.. fresh install using wp-cli and Docker

Install wp-cli if you haven't already:
https://make.wordpress.org/cli/handbook/guides/installing/

Change to the directory where you want to install this setup and install WP.

```
$ wp core download
```
Next change into the themes directory and clone this repository.

```
$ cd wp-content/themes
$ git clone https://github.com/jooplaan/twentytwentyone-valentinus.git
```

#### Set up development with Docker

Make sure [Docker](https://docs.docker.com/) is installed and running, and [wordpress/env](https://developer.wordpress.org/block-editor/packages/packages-env/) is installed.

##### To install Docker
https://docs.docker.com/engine/install/

#### To install @wordpress/env
https://developer.wordpress.org/block-editor/packages/packages-env/

### Starting the environment

Change to the directory that contains a this child theme:

```
$ cd wp-content/themes/twentytwentyone-valentinus
$ wp-env start
```

### Select the theme

After the Docker environment is started, we only need to select the theme.
Login to the admin section:
http://localhost:8888/wp-admin/

username: admin
password: password

Go to: http://localhost:8888/wp-admin/themes.php
And activate Valentinus Twenty Twenty One

### Ending

```
$ wp-env stop
```

