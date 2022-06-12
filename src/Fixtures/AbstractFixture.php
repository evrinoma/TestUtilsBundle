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

namespace Evrinoma\TestUtilsBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class AbstractFixture extends Fixture
{
    protected static array $data = [];

    protected static string $class = '';

    protected static string $splitter = '_';

    public static function getReferenceName(): string
    {
        return (new \ReflectionClass(static::$class))->getShortName().static::$splitter;
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->create($manager);

        $manager->flush();
    }

    public function getEntity()
    {
        return new static::$class();
    }

    protected function getData(): array
    {
        return static::$data;
    }

    abstract protected function create(ObjectManager $manager): self;
}
