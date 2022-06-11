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

namespace Evrinoma\TestUtilsBundle\ValueObject\Common;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;
use Evrinoma\TestUtilsBundle\ValueObject\ValueObjectTest;

abstract class AbstractId extends AbstractValueObject implements ValueObjectTest
{
    public static function value(): string
    {
        return static::$value ?? '1';
    }

    public static function wrong(): string
    {
        return static::$wrong ?? '100000';
    }

    public static function default(): string
    {
        return static::$default ?? '';
    }
}
