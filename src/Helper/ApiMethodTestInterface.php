<?php

namespace Evrinoma\TestUtilsBundle\Helper;

interface ApiMethodTestInterface
{
//region SECTION: Public
    public function postWrong(): array;

    public function post(array $query): array;

    public function delete(string $id): array;

    public function criteria(array $query): array;

    public function put(array $query): array;
//endregion Public

//region SECTION: Getters/Setters
    public function get(int $id): array;
//endregion Getters/Setters
}