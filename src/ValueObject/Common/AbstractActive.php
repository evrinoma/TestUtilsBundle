<?php

namespace Evrinoma\TestUtilsBundle\ValueObject\Common;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;
use Evrinoma\TestUtilsBundle\ValueObject\ValueObjectTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;

abstract class AbstractActive extends AbstractValueObject implements ValueObjectTest
{
//region SECTION: Fields
    private const ACTIVE_MODEL_WRONG = 'w';
//endregion Fields

//region SECTION: Public
    public static function value(): string
    {
        return static::$value ?? ActiveModel::ACTIVE;
    }

    public static function delete(): string
    {
        return ActiveModel::DELETED;
    }

    public static function moderate(): string
    {
        return ActiveModel::MODERATED;
    }

    public static function block(): string
    {
        return ActiveModel::BLOCKED;
    }

    public static function wrong(): string
    {
        return static::ACTIVE_MODEL_WRONG;
    }
//endregion Public
}