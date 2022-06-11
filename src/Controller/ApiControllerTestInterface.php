<?php

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