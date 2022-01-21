<?php

namespace Evrinoma\TestUtilsBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class AbstractFixture extends Fixture
{
    protected static array $data = [];

    protected static string $class = '';

    protected static string $splitter =  '_';

    public static function getReferenceName(): string
    {
        return (new \ReflectionClass(static::$class))->getShortName().static::$splitter;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->create($manager);

        $manager->flush();
    }

    abstract protected function create(ObjectManager $manager):self;
}