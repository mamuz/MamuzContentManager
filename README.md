# MamuzContentManager

[![Build Status](https://travis-ci.org/mamuz/MamuzContentManager.svg?branch=master)](https://travis-ci.org/mamuz/MamuzContentManager)
[![Dependency Status](https://www.versioneye.com/user/projects/538f789746c4739586000037/badge.svg)](https://www.versioneye.com/user/projects/538f789746c4739586000037)
[![Coverage Status](https://coveralls.io/repos/mamuz/MamuzContentManager/badge.png?branch=master)](https://coveralls.io/r/mamuz/MamuzContentManager?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mamuz/MamuzContentManager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mamuz/MamuzContentManager/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/mamuz/mamuz-content-manager/v/stable.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)
[![Total Downloads](https://poser.pugx.org/mamuz/mamuz-content-manager/downloads.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)
[![Latest Unstable Version](https://poser.pugx.org/mamuz/mamuz-content-manager/v/unstable.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)
[![License](https://poser.pugx.org/mamuz/mamuz-content-manager/license.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)

## Domain

 - This module provides a simple content management system.
 - Pages are persisted in a database and accessable by ZF2 routes.
 - Content for these pages will be parsed as markdown.

## Installation

The recommended way to install
[`mamuz/mamuz-content-manager`](https://packagist.org/packages/mamuz/mamuz-content-manager) is through
[composer](http://getcomposer.org/) by adding dependency to your `composer.json`:

```json
{
    "require": {
        "mamuz/mamuz-content-manager": "0.*"
    }
}
```

After that run `composer update` and enable this module for ZF2 by adding
`MamuzContentManager` to the `modules` key in `./config/application.config.php`:

```php
// ...
    'modules' => array(
        'MamuzContentManager',
    ),
```

This module is based on [`DoctrineORMModule`](https://github.com/doctrine/DoctrineORMModule)
and be sure that you have already [configured database connection](https://github.com/doctrine/DoctrineORMModule).

Create database tables with command line tool provided by
[`DoctrineORMModule`](https://github.com/doctrine/DoctrineORMModule):

### Dump the sql to fire it manually
```sh
./vendor/bin/doctrine-module  orm:schema-tool:update --dump-sql
```

### Fire sql automaticly

```sh
./vendor/bin/doctrine-module  orm:schema-tool:update --force
```

## Configuration

This module is already configured out of the box, but you can overwrite it by
adding a config file in `./config/autoload` directory.
For default configuration see
[`module.config.php`](https://github.com/mamuz/MamuzContentManager/blob/master/config/module.config.php)

## Creating new Pages

Create new entities in `MamuzPage` database table.
Content will be parsed as markdown.

## Workflow

If routing is successful to a page entity found by active flag and path property,
page content will be responsed in a new view model. Otherwise it will set a 404 status code
to http response object.
