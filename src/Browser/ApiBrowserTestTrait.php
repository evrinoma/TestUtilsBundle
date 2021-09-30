<?php

namespace Evrinoma\TestUtilsBundle\Browser;

use Symfony\Component\BrowserKit\AbstractBrowser;

trait ApiBrowserTestTrait
{
//region SECTION: Fields
    /**
     * @var AbstractBrowser|null
     */
    protected ?AbstractBrowser $client = null;

    protected static ?string $getUrl = null;

    protected static ?string $criteriaUrl = null;

    protected static ?string $deleteUrl = null;

    protected static ?string $putUrl = null;

    protected static ?string $postUrl = null;
//endregion Fields


//region SECTION: Public
    public function queryPost(array $query): array
    {
        $this->client->restart();
        if (static::$postUrl) {
            $this->client->request('POST', static::$postUrl, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($query));
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }

    public function queryDelete(array $query): array
    {
        $this->client->restart();
        if (static::$deleteUrl) {
            $this->client->request('DELETE', static::$deleteUrl, $query);
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }

    public function queryPut(array $query): array
    {
        $this->client->restart();
        if (static::$putUrl) {
            $this->client->request('PUT', static::$putUrl, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($query));
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }

    public function queryGet(array $query): array
    {
        $this->client->restart();
        if (static::$getUrl) {
            $this->client->request('GET', static::$getUrl, $query);
        } else {
            throw new \HttpUrlException();

        }

        return $this->toResponse();
    }

    public function queryCriteria(array $query): array
    {
        $this->client->restart();
        if (static::$criteriaUrl) {
            $this->client->request('GET', static::$criteriaUrl, $query);
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }
//endregion Public

//region SECTION: Getters/Setters
    public function toResponse(): array
    {
        return json_decode($this->client->getResponse()->getContent(), true);
    }
//endregion Getters/Setters
}