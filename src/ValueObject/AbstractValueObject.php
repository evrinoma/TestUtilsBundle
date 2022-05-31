<?php

namespace Evrinoma\TestUtilsBundle\ValueObject;

abstract class AbstractValueObject
{
//region SECTION: Fields
    protected static string $value;
    protected static string $wrong;
    protected static string $default;
//endregion Fields

//region SECTION: Public
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
//endregion Public
}