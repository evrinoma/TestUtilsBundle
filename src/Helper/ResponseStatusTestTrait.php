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

namespace Evrinoma\TestUtilsBundle\Helper;

use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait ResponseStatusTestTrait
{
    protected function testResponseStatusCreated(): void
    {
        Assert::assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusOK(): void
    {
        Assert::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusNotFound(): void
    {
        Assert::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusUnprocessable(): void
    {
        Assert::assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusConflict(): void
    {
        Assert::assertEquals(Response::HTTP_CONFLICT, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusAccepted(): void
    {
        Assert::assertEquals(Response::HTTP_ACCEPTED, $this->client->getResponse()->getStatusCode());
    }

    protected function testResponseStatusBadRequest(): void
    {
        Assert::assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }
}
