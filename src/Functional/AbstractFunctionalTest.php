<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    /**
     * @param ContainerInterface $container
     *
     * @return ActionTestInterface
     */
    abstract protected function getActionService(ContainerInterface $container): ActionTestInterface;

    protected function setUp(): void
    {
        parent::setUp();
        $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;
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
}
