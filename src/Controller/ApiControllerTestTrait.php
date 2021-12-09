<?php

namespace Evrinoma\TestUtilsBundle\Controller;

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;

trait ApiControllerTestTrait
{
//region SECTION: Fields
    protected ActionTestInterface $actionService;
//endregion Fields

//region SECTION: Protected
    /**
     * @param ActionTestInterface $actionService
     */
    abstract protected function setActionService(ActionTestInterface $actionService): void;
//endregion Protected

//region SECTION: Public
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
//endregion Public
}