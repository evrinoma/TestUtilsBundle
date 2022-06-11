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

interface ApiControllerTestInterface
{
    public function testGet(): void;

    public function testGetNotFound(): void;

    public function testCriteria(): void;

    public function testCriteriaNotFound(): void;

    public function testPut(): void;

    public function testPutNotFound(): void;

    public function testPutUnprocessable(): void;

    public function testDelete(): void;

    public function testDeleteNotFound(): void;

    public function testDeleteUnprocessable(): void;

    public function testPost(): void;

    public function testPostDuplicate(): void;

    public function testPostUnprocessable(): void;
}
