<?php

namespace Evrinoma\TestUtilsBundle\ValueObject;

interface ValueObjectTest
{

    public static function default(): string;

    public static function value(): string;

    public static function wrong(): string;

    public static function empty(): string;

    public static function nullable();
}