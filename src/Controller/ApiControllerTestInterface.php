<?php

namespace Evrinoma\TestUtilsBundle\Controller;

interface ApiControllerTestInterface
{
//region SECTION: Public
    public function testCriteria(): void;

    public function testCriteriaNotFound(): void;

    public function testPut(): void;

    public function testPutNotFound(): void;

    public function testPutUnprocessable(): void;

    public function testDelete(): void;

    public function testDeleteNotFound(): void;

    public function testDeleteUnprocessable(): void;

    public function testGet(): void;

    public function testGetNotFound(): void;
//endregion Public
}