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

namespace Evrinoma\TestUtilsBundle\Controller;

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;

trait ApiControllerTestTrait
{
    protected ActionTestInterface $actionService;

    /**
     * @param ActionTestInterface $actionService
     */
    abstract protected function setActionService(ActionTestInterface $actionService): void;

    public function testPost(): void
    {
        $this->actionService->actionPost();
    }

    public function testPostDuplicate(): void
    {
        $this->actionService->actionPostDuplicate();
    }

    public function testPostUnprocessable(): void
    {
        $this->actionService->actionPostUnprocessable();
    }

    public function testCriteria(): void
    {
        $this->actionService->actionCriteria();
    }

    public function testCriteriaNotFound(): void
    {
        $this->actionService->actionCriteriaNotFound();
    }

    public function testPut(): void
    {
        $this->actionService->actionPut();
    }

    public function testPutNotFound(): void
    {
        $this->actionService->actionPutNotFound();
    }

    public function testPutUnprocessable(): void
    {
        $this->actionService->actionPutUnprocessable();
    }

    public function testDelete(): void
    {
        $this->actionService->actionDelete();
    }

    public function testDeleteNotFound(): void
    {
        $this->actionService->actionDeleteNotFound();
    }

    public function testDeleteUnprocessable(): void
    {
        $this->actionService->actionDeleteUnprocessable();
    }

    public function testGet(): void
    {
        $this->actionService->actionGet();
    }

    public function testGetNotFound(): void
    {
        $this->actionService->actionGetNotFound();
    }
}
