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

abstract class AbstractIdentity extends AbstractValueObject implements ValueObjectTest
{
    public static function value(): string
    {
        return static::$value ?? '';
    }

    public static function wrong(): string
    {
        return strrev(static::value());
    }

    public static function default(): string
    {
        return static::$default ?? '';
    }
}
