# TYPO3 Whoops

[![Build Status](https://travis-ci.org/portrino/typo3-whoops.svg?branch=master)](https://travis-ci.org/portrino/typo3-whoops)
[![Latest Stable Version](https://poser.pugx.org/portrino/typo3-whoops/v/stable)](https://packagist.org/packages/portrino/typo3-whoops)
[![Total Downloads](https://poser.pugx.org/portrino/typo3-whoops/downloads)](https://packagist.org/packages/portrino/typo3-whoops)

Use the [whoops](http://filp.github.io/whoops/) error/ exception handler instead of the default DebugExceptionHandler 
shipped within the TYPO3 core. This supports you with a nicer exception handling output in the frontend or on cli during
extension development. Should only be used in a (local) development context!

## Getting started

### Install using composer

```bash
$ composer require --dev portrino/typo3-whoops
```

### Activation

#### via AdditionalConfiguration.php

Add the following lines into your `typo3conf/AdditionalConfiguration.php`:

```php
$GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = 
    \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = 
    \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
``` 

We **highly recommend** to use a context related condition around it. For example:

```php
$applicationContext = \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString();
if (strpos($applicationContext, 'Development') !== false) {

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = 
        \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = 
        \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
        
}
```

##### Compatibility for PHP versions < 7

Because the ``ExceptionHandlerInterface`` under php5.5 and 5.6 differs from the one from php > 7 
we provide you a compatible version of the ``WhoopsExceptionHandler``.

```php
$GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = 
    \Portrino\Typo3Whoops\Compatibility\Error\WhoopsExceptionHandler::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = 
    \Portrino\Typo3Whoops\Compatibility\Error\WhoopsExceptionHandler::class;
``` 


#### via TYPO3 Console

```bash
typo3cms configuration:set --path SYS/debugExceptionHandler --value "Portrino\\Typo3Whoops\\Error\\WhoopsExceptionHandler"
typo3cms configuration:set --path SYS/productionExceptionHandler --value "Portrino\\Typo3Whoops\\Error\\WhoopsExceptionHandler"
```

## Usage

Now trigger an exception somewhere in your extension code and you should see php errors for cool kids.

![Whoops!](http://i.imgur.com/0VQpe96.png)

## Authors

![](https://avatars0.githubusercontent.com/u/540478?s=40&v=4)
![](https://avatars0.githubusercontent.com/u/726519?s=40&v=4)

* **Axel Böswetter** - *Initial work* - [EvilBMP](https://github.com/EvilBMP)
* **André Wuttig** - *Bugfixes, Unit Tests, Acceptance Tests, Travis CI Integration* - [aWuttig](https://github.com/aWuttig)

See also the list of [contributors](https://github.com/portrino/typo3-whoops/graphs/contributors) who participated in this project.
