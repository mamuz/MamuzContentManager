# MamuzContentManager

[![Build Status](https://travis-ci.org/mamuz/MamuzContentManager.svg?branch=master)](https://travis-ci.org/mamuz/MamuzContentManager)
[![Coverage Status](https://coveralls.io/repos/mamuz/MamuzContentManager/badge.png?branch=master)](https://coveralls.io/r/mamuz/MamuzContentManager?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mamuz/MamuzContentManager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mamuz/MamuzContentManager/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/91b1b958-582d-49ee-b5af-699597c5de95/mini.png)](https://insight.sensiolabs.com/projects/91b1b958-582d-49ee-b5af-699597c5de95)
[![HHVM Status](http://hhvm.h4cc.de/badge/mamuz/mamuz-content-manager.png)](http://hhvm.h4cc.de/package/mamuz/mamuz-content-manager)
[![Dependency Status](https://www.versioneye.com/user/projects/538f789246c473958600002c/badge.svg)](https://www.versioneye.com/user/projects/538f789246c473958600002c)

[![Latest Stable Version](https://poser.pugx.org/mamuz/mamuz-content-manager/v/stable.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)
[![Latest Unstable Version](https://poser.pugx.org/mamuz/mamuz-content-manager/v/unstable.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)
[![Total Downloads](https://poser.pugx.org/mamuz/mamuz-content-manager/downloads.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)
[![License](https://poser.pugx.org/mamuz/mamuz-content-manager/license.svg)](https://packagist.org/packages/mamuz/mamuz-content-manager)

## Features

 - This module provides a CMS based on ZF2 and Doctrine2.
 - Pages are persistent in repository and accessable by ZF2 routes.
 - Pages are rendered by a markdown parser.

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

```sh
./vendor/bin/doctrine-module orm:schema-tool:update
```

## Configuration

This module is usable out of the box, but you can overwrite default configuration by
adding a config file in `./config/autoload` directory.
For default configuration see
[`module.config.php`](https://github.com/mamuz/MamuzContentManager/blob/master/config/module.config.php)

## Creating a new Page

Create an entity in `MamuzPage` repository.

*Admin Module to provide an interface for that is planned.*

## Workflow

In case of successful routing `page` parameter is used to find a page entity by `path` property.
If found page is flagged as `published`, `content` will be rendered by a markdown parser and pushed
to the HTTP-Response object as a new view model,
otherwise a 404 HTTP status code will be set to the HTTP-Response object.

## Events

For the sake of simplicity `Event` is used for
FQN [`MamuzContentManager\EventManager\Event`](https://github.com/mamuz/MamuzContentManager/blob/master/src/MamuzContentManager/EventManager/Event.php).

The following events are triggered by `Event::IDENTIFIER` *mamuz-content-manager*:

Name                           | Constant                     | Description
------------------------------ | ---------------------------- | -----------
*findPublishedPageByPath.pre*  | `Event::PRE_PAGE_RETRIEVAL`  | Before page retrieval by path
*findPublishedPageByPath.post* | `Event::POST_PAGE_RETRIEVAL` | After page retrieval by path
