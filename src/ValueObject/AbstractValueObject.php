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

namespace Evrinoma\TestUtilsBundle\ValueObject;

abstract class AbstractValueObject
{
    protected static string $value;
    protected static string $wrong;
    protected static string $default;

    public static function value(): ?string
    {
        return static::$value;
    }

    public static function wrong(): ?string
    {
        return static::$wrong;
    }

    public static function empty(): string
    {
        return '';
    }

    public static function nullable()
    {
        return null;
    }

    public static function default(): ?string
    {
        return static::$default;
    }
}
