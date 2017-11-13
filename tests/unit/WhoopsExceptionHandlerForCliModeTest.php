<?php


use Portrino\Typo3Whoops\Error\WhoopsExceptionHandler;
use Prophecy\Prophecy\ObjectProphecy;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\EnvironmentService;
use Whoops\Handler\HandlerInterface;
use Whoops\Handler\PlainTextHandler;

/**
 * Class WhoopsExceptionHandlerForCliModeTest
 */
class WhoopsExceptionHandlerForCliModeTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var WhoopsExceptionHandler|PHPUnit_Framework_MockObject_MockObject
     */
    protected $whoopsExceptionHandler;

    protected function _before()
    {
        $environmentService = $this->prophesize(EnvironmentService::class);
        $environmentService->isEnvironmentInCliMode()->willReturn(true);

        GeneralUtility::setSingletonInstance(EnvironmentService::class, $environmentService->reveal());

        if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION >= 7) {
            $exceptionHandlerClass = WhoopsExceptionHandler::class;
        } else {
            $exceptionHandlerClass = \Portrino\Typo3Whoops\Compatibility\Error\WhoopsExceptionHandler::class;
        }
        $this->whoopsExceptionHandler = new $exceptionHandlerClass;
    }

    protected function _after()
    {
    }

    // tests
    public function testIfWhoopsPlainTextHandlerIsRegisteredWhenInCliMode()
    {
        $whoops = $this->whoopsExceptionHandler->getWhoops();
        /** @var Callable|HandlerInterface $actualHandler */
        $actualHandler = $whoops->getHandlers()[0];
        $this->assertEquals(PlainTextHandler::class, get_class($actualHandler));
    }
}