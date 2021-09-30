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

    protected ?string $getUrl = null;

    protected ?string $criteriaUrl = null;

    protected ?string $deleteUrl = null;

    protected ?string $putUrl = null;

    protected ?string $postUrl = null;
//endregion Fields


//region SECTION: Public
    public function queryPost(array $query): array
    {
        $this->client->restart();
        if ($this->postUrl) {
            $this->client->request('POST', $this->postUrl, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($query));
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }

    public function queryDelete(array $query): array
    {
        $this->client->restart();
        if ($this->deleteUrl) {
            $this->client->request('DELETE', $this->deleteUrl, $query);
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }

    public function queryPut(array $query): array
    {
        $this->client->restart();
        if ($this->putUrl) {
            $this->client->request('PUT', $this->putUrl, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($query));
        } else {
            throw new \HttpUrlException();
        }

        return $this->toResponse();
    }

    public function queryGet(array $query): array
    {
        $this->client->restart();
        if ($this->getUrl) {
            $this->client->request('GET', $this->getUrl, $query);
        } else {
            throw new \HttpUrlException();

        }

        return $this->toResponse();
    }

    public function queryCriteria(array $query): array
    {
        $this->client->restart();
        if ($this->criteriaUrl) {
            $this->client->request('GET', $this->criteriaUrl, $query);
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