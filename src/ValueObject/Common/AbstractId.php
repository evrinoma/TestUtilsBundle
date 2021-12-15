<?php

namespace Evrinoma\TestUtilsBundle\ValueObject\Common;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;
use Evrinoma\TestUtilsBundle\ValueObject\ValueObjectTest;

abstract class AbstractId extends AbstractValueObject implements ValueObjectTest
{
//region SECTION: Public
    public static function value(): string
    {
        return static::$value ?? '1';
    }

    public static function wrong(): string
    {
        return static::$wrong ?? '100000';
    }
//endregion Public
}