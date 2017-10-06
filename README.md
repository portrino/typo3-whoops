# TYPO3 Whoops

[![Build Status](https://travis-ci.org/portrino/typo3-whoops.svg?branch=master)](https://travis-ci.org/portrino/typo3-whoops)

Use the [whoops](http://filp.github.io/whoops/) error/ exception handler instead of the default DebugExceptionHandler 
shipped within the TYPO3 core. This supports you with a nicer exception handling output in the frontend or on cli during
extension development. Should only be used in a (local) development context!

## Getting started

### Install using composer

```bash
$ composer require --dev portrino/typo3-whoops
```

### Activate the whoops error/ exception handler in our TYPO3 installation

Add the following lines into your `typo3conf/AdditionalConfiguration.php`:

```php
$GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = 
    \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = 
    \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
``` 

I **highly recommend** to use a context related condition around it. For example:


```php
$applicationContext = \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString();
if (strpos($applicationContext, 'Development') !== false) {

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = 
        \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = 
        \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
        
}
```

## Usage

Now trigger an exception somewhere in your extension code and you should see something like this:

![Whoops!](http://i.imgur.com/0VQpe96.png)
