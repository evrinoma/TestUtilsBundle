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
use Evrinoma\UtilsBundle\Model\ActiveModel;

abstract class AbstractActive extends AbstractValueObject implements ValueObjectTest
{
    protected const ACTIVE_MODEL_WRONG = 'w';

    public static function default(): string
    {
        return static::$default ?? '';
    }

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
}
