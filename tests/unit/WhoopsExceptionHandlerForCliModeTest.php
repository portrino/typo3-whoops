<?php


use Portrino\Typo3Whoops\Error\WhoopsExceptionHandler;
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
        $environementServiceMock = $this->getMockBuilder(EnvironmentService::class)
            ->setMethods(
                [
                    'isEnvironmentInCliMode'
                ]
            )->getMock();

        $environementServiceMock
            ->expects(static::any())
            ->method('isEnvironmentInCliMode')
            ->willReturn(true);

        GeneralUtility::setSingletonInstance(EnvironmentService::class, $environementServiceMock);

        $this->whoopsExceptionHandler = new WhoopsExceptionHandler();
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