# danbelden/php-siren

[![Build Status](https://travis-ci.org/danbelden/php-siren.svg?branch=master)](https://travis-ci.org/danbelden/php-siren)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/danbelden/php-siren/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/danbelden/php-siren/?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/6fb500c415e1e62a37b5/maintainability)](https://codeclimate.com/github/danbelden/php-siren/maintainability)
[![Latest Stable Version](https://poser.pugx.org/danbelden/php-siren/v/stable)](https://packagist.org/packages/danbelden/php-siren)
[![Total Downloads](https://poser.pugx.org/danbelden/php-siren/downloads)](https://packagist.org/packages/danbelden/php-siren)
[![License](https://poser.pugx.org/danbelden/php-siren/license)](https://packagist.org/packages/danbelden/php-siren)

A PHP Library for handling Siren JSON hypermedia documents

# Overview

This is a library based around the Siren hypermedia data standard:
- https://github.com/kevinswiber/siren
- https://groups.google.com/forum/#!forum/siren-hypermedia

It provides objects and validation for handling this structured data format.

# Requires

PHP 5.3 and above.

# Installation

## Composer

To install this package with composer, run the following command:

```composer require danbelden/php-siren "^1.0"```

# Documentation

Using the example target JSON defined in the standards:
- https://github.com/kevinswiber/siren

```
$document = new Document();
$document->addClass('order');

$properties = [
    'orderNumber' => 42,
    'itemCount'   => 3,
    'status'      => 'pending'
];
$document->setProperties($properties);

$entityOne = new Entity();
$entityOne->setClass([ 'items', 'collection' ])
    ->setRel([ 'http://x.io/rels/order-items' ])
    ->setHref('http://api.x.io/orders/42/items');

$entityTwoLink = new Link();
$entityTwoLink->setRel([ 'self' ])
    ->setHref('http://api.x.io/customers/pj123');

$entityTwo = new Entity();
$entityTwo->setClass([ 'info', 'customer' ])
    ->setRel([ 'http://x.io/rels/customer' ])
    ->setProperties([
        'customerId' => 'pj123',
        'name' => 'Peter Joseph'
    ])
    ->setLinks([ $entityTwoLink ]);

$entities = [ $entityOne, $entityTwo ];
$document->setEntities($entities);

$actionFieldOne = new Field();
$actionFieldOne->setName('orderNumber')
    ->setType('hidden')
    ->setValue('42');

$actionFieldTwo = new Field();
$actionFieldTwo->setName('productCode')
    ->setType('text');

$actionFieldThree = new Field();
$actionFieldThree->setName('quantity')
    ->setType('number');

$actionOne = new Action();
$actionOne->setName('add-item')
    ->setTitle('Add Item')
    ->setMethod('POST')
    ->setHref('http://api.x.io/orders/42/items')
    ->setType('application/x-www-form-urlencoded')
    ->setFields([ $actionFieldOne, $actionFieldTwo, $actionFieldThree ]);

$actions = [ $actionOne ];
$document->setActions($actions);

$linkOne = new Link();
$linkOne->setRel([ 'self' ])
    ->setHref('http://api.x.io/orders/42');

$linkTwo = new Link();
$linkTwo->setRel([ 'previous' ])
    ->setHref('http://api.x.io/orders/41');

$linkThree = new Link();
$linkThree->setRel([ 'next' ])
    ->setHref('http://api.x.io/orders/43');

$links = [ $linkOne, $linkTwo, $linkThree ];
$document->setLinks($links);
```

Enjoy.
