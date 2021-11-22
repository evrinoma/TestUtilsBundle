<?php

namespace Evrinoma\TestUtilsBundle\Helper;

trait ApiMethodTestTrait
{
//region SECTION: Public
    public function postWrong(): array
    {
        return $this->post([]);
    }

    public function post(array $query): array
    {
        return $this->queryPost($query);
    }

    public function delete(string $id): array
    {
        return $this->queryDelete(["class" => static::getDtoClass(), "id" => $id,]);
    }

    public function criteria(array $query): array
    {
        return $this->queryCriteria($query);
    }

    public function put(array $query): array
    {
        return $this->queryPut($query);
    }
//endregion Public

//region SECTION: Getters/Setters
    public function get(string $id): array
    {
        return $this->queryGet(["class" => static::getDtoClass(), "id" => $id,]);
    }
//endregion Getters/Setters
}