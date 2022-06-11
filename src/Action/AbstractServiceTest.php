<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    protected const API_GET      = '';
    protected const API_CRITERIA = '';
    protected const API_DELETE   = '';
    protected const API_PUT      = '';
    protected const API_POST     = '';
    protected static array $default = [];

    public function __construct()
    {
        static::$default = static::defaultData();
    }

    abstract protected static function getDtoClass(): string;

    abstract protected static function defaultData(): array;

    public static function merge(array $base = [], array $extend = []): array
    {
        return array_merge(unserialize(serialize($base)), $extend);
    }

    public static function getDefault(array $extend = []): array
    {
        return static::merge(static::$default, $extend);
    }

    public function setClient(?AbstractBrowser $client): void
    {
        $this->client = $client;
    }
}
