<?php

namespace Evrinoma\TestUtilsBundle\ValueObject\Common;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;
use Evrinoma\TestUtilsBundle\ValueObject\ValueObjectTest;

abstract class AbstractIdentity extends AbstractValueObject implements ValueObjectTest
{
//region SECTION: Public
    public static function value(): string
    {
        return static::$value ?? '';
    }

    public static function wrong(): string
    {
        return strrev(static::value());
    }
//endregion Public
}