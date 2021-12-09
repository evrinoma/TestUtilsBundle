<?php

namespace Evrinoma\TestUtilsBundle\ValueObject;

interface ValueObjectTest
{
//region SECTION: Public
    public static function value(): string;

    public static function wrong(): string;

    public static function empty(): string;

    public static function nullable();
//endregion Public
}