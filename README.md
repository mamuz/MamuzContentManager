# MamuzContentManager

[![Build Status](https://travis-ci.org/mamuz/MamuzContentManager.svg?branch=master)](https://travis-ci.org/mamuz/MamuzContentManager)
[![Dependency Status](https://www.versioneye.com/user/projects/538f789746c4739586000037/badge.svg)](https://www.versioneye.com/user/projects/538f789746c4739586000037)
[![Coverage Status](https://coveralls.io/repos/mamuz/MamuzContentManager/badge.png?branch=master)](https://coveralls.io/r/mamuz/MamuzContentManager?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mamuz/MamuzContentManager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mamuz/MamuzContentManager/?branch=master)

## Installation

Run doctrine orm command line to create database table:

Dump the sql..
```sh
./vendor/bin/doctrine-module  orm:schema-tool:update --dump-sql
```
Force update
```sh
./vendor/bin/doctrine-module  orm:schema-tool:update --force
```
In usage of environment variable..
```sh
export APPLICATION_ENV=development; ./vendor/bin/doctrine-module  orm:schema-tool:update
```

## Configuration

Change routing in module config, which will be resolved to path property of page entity.

## Creating new Pages

Create new entities in page database table and set page content to content property.
Content will be parsed as markdown.

## Workflow

If routing is successful to a page entity found by active flag and path property,
page content will be responsed in a new view model. Otherwise it will set 404 status code
to http response object.
