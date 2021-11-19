<?php


namespace Evrinoma\TestUtilsBundle\Helper;

use Symfony\Component\HttpFoundation\Response;

trait ResponseStatusTestTrait
{
//region SECTION: Protected
    protected function testResponseStatusCreated(): void
    {
        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusOK(): void
    {
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusNotFound(): void
    {
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusUnprocessable(): void
    {
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusConflict(): void
    {
        $this->assertEquals(Response::HTTP_CONFLICT, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusAccepted(): void
    {
        $this->assertEquals(Response::HTTP_ACCEPTED, $this->client->getResponse()->getStatusCode());
    }
//endregion Protected

}