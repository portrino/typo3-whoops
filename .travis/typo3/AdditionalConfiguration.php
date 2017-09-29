<?php

$GLOBALS['TYPO3_CONF_VARS']['SYS']['debugExceptionHandler'] = \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = \Portrino\Typo3Whoops\Error\WhoopsExceptionHandler::class;
