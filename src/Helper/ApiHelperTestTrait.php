<?php

namespace Evrinoma\TestUtilsBundle\Helper;

trait ApiHelperTestTrait
{
//region SECTION: Public
    public function postWrong(): array
    {
        $query = [];

        return $this->post($query);
    }

    public function post(array $query): array
    {
        return $this->queryPost($query);
    }

    public function delete(string $id): array
    {
        $query = ["class" => static::getDtoClass(), "id" => $id,];

        return $this->queryDelete($query);
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
    public function get(int $id): array
    {
        $query = ["class" => static::getDtoClass(), "id" => $id,];

        return $this->queryGet($query);
    }
//endregion Getters/Setters
}