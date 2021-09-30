<?php

namespace Evrinoma\TestUtilsBundle\Controller;

interface ApiQueryBrowserTestInterface
{
    public function queryCreate(array $query): void;

    public function queryDelete(array $query): void;

    public function queryPut(array $query): void;

    public function queryGet(array $query): void;

    public function queryCriteria(array $query): void;
}