<?php
namespace Portrino\Typo3Whoops\Error;

/*
 * This file is part of the TYPO3 Whoops project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Error\AbstractExceptionHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Class WhoopsExceptionHandler
 *
 * @package Portrino\Typo3Whoops\Error
 */
class WhoopsExceptionHandler extends AbstractExceptionHandler
{

    /**
     * Constructs this exception handler - registers itself as the default exception handler.
     */
    public function __construct()
    {
        $whoops = new Run;

        switch (PHP_SAPI) {
            case 'cli':
                $whoops->pushHandler(new PlainTextHandler());
                break;
            default:
                $whoops->pushHandler(new PrettyPageHandler());
        }

        $whoops->register();
    }

    /**
     * Formats and echoes the exception as XHTML.
     *
     * @param \Exception|\Throwable $exception The exception(PHP 5.x) or throwable(PHP >= 7.0) object.
     * @return void
     */
    public function echoExceptionWeb($exception)
    {
    }

    /**
     * Formats and echoes the exception for the command line
     *
     * @param \Exception|\Throwable $exception The exception(PHP 5.x) or throwable(PHP >= 7.0) object.
     * @return void
     */
    public function echoExceptionCLI($exception)
    {
    }
}
