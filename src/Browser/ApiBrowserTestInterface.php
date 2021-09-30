<?php

namespace Evrinoma\TestUtilsBundle\Browser;

interface ApiBrowserTestInterface
{
    public function queryPost(array $query): array;

    public function queryDelete(array $query): array;

    public function queryPut(array $query): array;

    public function queryGet(array $query): array;

    public function queryCriteria(array $query): array;

    public function toResponse(): array;
}