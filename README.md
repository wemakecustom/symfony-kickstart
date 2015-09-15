# How to create a new Symfony project

## Setup

1. Clone this project anywhere outside your web folder. This package will be used to create new Symfony projects and does not need to be cloned every time.
2. Run the "symfony-kickstart" script from the "bin" directory and give you new project's path as the first argument. The new project's directory must NOT exist prior to running the script.
3. Start building your new project!

## Hosting environment specific configuration

Hosting environment specific configurations are used to achieve the same goal as
`parameters.yml.dist`. However, in `.PROD`, these configuration are
automatically generated. We therefore need them to be included in symfony via a
specific worflow.

[Checkout the `confs` directory](confs):

An example for a MySQL database (`doctrine/orm` conf) is available:

  * app/config/conf.d/database.php
  * confs/samples/database.ini

## Commonly used bundles

The first list of each section should be installed via composer. The others are
simply here for reference.

### Misc Toolkit

  * `symfony2-bundles/wmccommonbundle:*`

### Form and Twitter bootstrap

  * `mopa/bootstrap-bundle:dev-master`
  * `twbs/bootstrap:3.0.x`
  * `leafo/lessphp:*`

### Sitemap

  * `presta/sitemap-bundle:dev-master`

### Doctrine (DBAL/ORM)

  * `symfony2-bundles/wmcdoctrinebundle:*`

  * `doctrine/orm`

#### Doctrine Extensions

  * `stof/doctrine-extensions-bundle:~1.1@dev`

  * `gedmo/doctrine-extensions`

### Anotations to declare services

  * `jms/di-extra-bundle:1.x`

### Users Management / Authentication

  * `"friendsofsymfony/user-bundle":"~2.0@dev"` https://github.com/FriendsOfSymfony/FOSUserBundle/tree/master

#### Anotations to handle Authorization (`@Secure`)

  * `"jms/security-extra-bundle":"1.x"` https://github.com/schmittjoh/JMSSecurityExtraBundle

### Menu management

  * `symfony2-bundles/wmcmenubundle:*`

  * `knplabs/knp-menu-bundle`

### Assets dependecies management

  * `sp/bower-bundle:dev-master`

### Routing via JavaScript

  * `friendsofsymfony/jsrouting-bundle:*`

### OAuth Authentication

  * `hwi/oauth-bundle:0.3.*@dev`

Take a look to http://gitlab.wemakecustom.com/tcfj/mon-conseil

### Facebook API

  * `friendsofsymfony/facebook-bundle:1.2.*`

  * `facebook/php-sdk`

Take a look to http://gitlab.wemakecustom.com/tcfj/mon-conseil

### Twitter API

  * `symfony2-bundles/wmctwitterbundle:*`
  * `ocramius/proxy-manager:*`

  * `themattharris/tmhoauth`

Take a look to http://gitlab.wemakecustom.com/tcfj/mon-conseil

## TODO:

  * Add a link to each bundle git repo/documentation in the Commonly used list


## Commonly bower install

* jquery 2.0+ 
* jquery-migrate
* console-polyfill    :  Adds no-operation **console methods** to environments where console is not available.
* underscore          :  Provides a whole mess of useful functional programming helpers.
* font-awesome
* html5shiv           :  Enables use of **HTML5** sectioning elements in legacy IE and provides basic HTML5 styling.
* respond             :  A fast & lightweight polyfill for min/max-width CSS3 **Media Queries** (for IE 6-8, and more).
