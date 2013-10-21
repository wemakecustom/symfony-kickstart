# How to create a new Symfony project

## Initial Setup

  1. First create the project using the
     https://github.com/symfony/symfony-standard edition (`composer.phar
     create-project symfony/framework-standard-edition path/to/install`)
  2. Delete the AcmeBundle (and be done with it, See symfony-standard README, you should completely disable security instead of following their (faulty) protocol)
  3. Add the [drop-in config importer](app/config/config.php)
  4. Update `AppKernel::registerContainerConfiguration` in `app/AppKernel.php` to `$loader->load(__DIR__.'/config/config.php');`.
  5. Delete `config*.yml`, copy all `app/conf*.d` and edit to your needs.
  6. Update `parameters.yml.dist` to use our [default one](app/config/parameters.yml.dist)
  7. Update `composer.json` config to use our default options (See below)
  8. Update `composer.json` to use [WMC's gitlab](http://gitlab-composer.stage.wemakecustom.com/)
     as a [source of repositories](https://github.com/wemakecustom/gitlab-composer)
  9. Update `.gitignore` to use our [default one](.gitignore)
  10. Install [wemakecustom/symfony-app-loader:~1.0@dev](https://github.com/wemakecustom/symfony-app-loader)
  11. Delete `htdocs/config.php`
  12. Install strongly recommended bundles (you will almost always need them anyway):
     * [symfony2-bundles/wmccommonbundle:*](http://gitlab.wemakecustom.com/symfony2-bundles/wmccommonbundle)
     * [sp/bower-bundle:dev-master](https://github.com/Spea/SpBowerBundle)
     * [jms/di-extra-bundle:1.x](https://github.com/schmittjoh/JMSDiExtraBundle)
     * [leafo/lessphp:*](https://github.com/leafo/lessphp)
  13. Create the `confs` directory for Hosting environment specific configs (See below).

## composer.json configuration

Only the differences with `symfony/framework-standard-edition`'s default are
mentioned here.

```json
    "minimum-stability": "dev",
    "prefer-stable": true,
    "extra": {
        "symfony-app-dir": "app",
        "symfony-web-dir": "htdocs",
        "symfony-assets-install": "relative"
    }
```

This implies using `htdocs` instead of `web` as the web dir. Remember to update
your `.gitignore` if needed.

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
  * Create a shell script to make the initial setup automatic