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

interface ValueObjectTest
{
    public static function default(): string;

    public static function value(): string;

    public static function wrong(): string;

    public static function empty(): string;

    public static function nullable();
}
