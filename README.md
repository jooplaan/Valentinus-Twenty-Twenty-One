# Valentinus Twenty Twenty One
A WordPress child theme for the Twenty Twenty-One theme.

## Fresh install using zip file
Simplest way to use this:

* [Download the latest version](https://github.com/jooplaan/twentytwentyone-valentinus/releases/latest)
* Unzip or untar the dowloaded archive
* Put the folder to your theme folder of your install
* Activate the Valentinus Twenty Twenty One child theme in the WordPress admin
* Hack it to your liking

## Fresh install using wp-cli

Install wp-cli if you haven't already:
https://make.wordpress.org/cli/handbook/guides/installing/

Change to the directory where you want to install this setup and install WP.

```
$ wp core download
```

Next change into the themes directory and checkout this repository.

```
$ cd wp-content/themes
$ git clone https://github.com/jooplaan/twentytwentyone-valentinus.git
```

## Development with Docker

Make sure Docker is installed and running, and you have wordpress/env installed.

### Install Docker
https://docs.docker.com/engine/install/

### Install @wordpress/env
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

## Development
This child theme started using the in-dept review of the Twenty Twenty One with tutorial how to create a child theme from:
https://kinsta.com/blog/twenty-twenty-one-theme/
Check this blog post for ideas to create your own custom Twenty Twenty One child theme.



