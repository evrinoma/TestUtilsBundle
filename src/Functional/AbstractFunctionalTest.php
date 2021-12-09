<?php

namespace Evrinoma\TestUtilsBundle\Functional;

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestTrait;
use Evrinoma\TestUtilsBundle\Helper\AbstractSymfony;
use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractFunctionalTest extends AbstractWebCaseTest implements ApiControllerTestInterface
{
    use ApiControllerTestTrait;
    protected string $actionServiceName = '';
//region SECTION: Protected
    /**
     * @param ContainerInterface $container
     *
     * @return ActionTestInterface
     */
    abstract protected function getActionService(ContainerInterface $container): ActionTestInterface;

    protected function setUp(): void
    {
        parent::setUp();
        $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;;
        $actionService = $this->getActionService($container);
        $actionService->setClient($this->client);
        $actionService->setUrl();
        $this->setActionService($actionService);
    }

    /**
     * @param ActionTestInterface $actionService
     */
    protected function setActionService(ActionTestInterface $actionService): void
    {
        $this->actionService = $actionService;
    }
//endregion Protected
}