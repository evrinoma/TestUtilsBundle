<?php

namespace Evrinoma\TestUtilsBundle\Action;

use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ResponseStatusTestTrait;
use Symfony\Component\BrowserKit\AbstractBrowser;

abstract class AbstractServiceTest implements ActionTestInterface
{
    use ApiBrowserTestTrait;
    use ApiMethodTestTrait;
    use ResponseStatusTestTrait;

//region SECTION: Fields
    protected const API_GET      = '';
    protected const API_CRITERIA = '';
    protected const API_DELETE   = '';
    protected const API_PUT      = '';
    protected const API_POST     = '';
    protected static array $default = [];
//endregion Fields

//region SECTION: Constructor
    public function __construct()
    {
        static::$default = static::defaultData();
    }
//endregion Constructor

//region SECTION: Protected
    abstract protected static function getDtoClass(): string;

    abstract protected static function defaultData(): array;
//endregion Protected

//region SECTION: Public
    public static function merge(array $base = [], array $extend = []): array
    {
        return array_merge(unserialize(serialize($base)), $extend);
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getDefault(array $extend = []): array
    {
        return static::merge(static::$default, $extend);
    }

    public function setClient(?AbstractBrowser $client): void
    {
        $this->client = $client;
    }
//endregion Getters/Setters
}