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

use Throwable;
use TYPO3\CMS\Core\Error\AbstractExceptionHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\EnvironmentService;
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
     * @var Run
     */
    protected $whoops;

    /**
     * @var EnvironmentService
     */
    protected $environmentService;

    /**
     * WhoopsExceptionHandler constructor.
     */
    public function __construct()
    {
        $this->environmentService = $this->createEnvironmentService();

        $this->whoops = new Run();

        if ($this->environmentService->isEnvironmentInCliMode()) {
            $this->whoops->pushHandler(new PlainTextHandler());
        } else {
            $this->whoops->pushHandler(new PrettyPageHandler());
        }

        $this->whoops->register();
    }

    /**
     * @return EnvironmentService
     */
    public function createEnvironmentService()
    {
        /** @var EnvironmentService $result */
        $result = GeneralUtility::makeInstance(EnvironmentService::class);
        return $result;
    }

    /**
     * @return Run
     */
    public function getWhoops()
    {
        return $this->whoops;
    }

    /**
     * Formats and echoes the exception as XHTML.
     *
     * @param Throwable $exception The throwable object.
     */
    public function echoExceptionWeb(Throwable $exception)
    {
    }

    /**
     * Formats and echoes the exception for the command line
     *
     * @param Throwable $exception The throwable object.
     */
    public function echoExceptionCLI(Throwable $exception)
    {
    }
}
