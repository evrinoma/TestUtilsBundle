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

namespace Evrinoma\TestUtilsBundle\Helper;

use Doctrine\ORM\EntityManagerInterface;

trait DoctrineTestTrait
{
    private EntityManagerInterface $em;

    /**
     * Мусор, образующийся при выполнении очередного теста, который надо удалить перед выполнением следующего теста.
     */
    private array $garbage = [];

    protected function setEntityManager($container)
    {
        $this->em = $container->get('doctrine.orm.default_entity_manager');
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    protected function clean(): void
    {
        while ($entity = array_pop($this->garbage)) {
            $this->rm($entity->getClass(), $entity->getId());
        }
    }

    /**
     * @param string      $id
     * @param string|null $class
     */
    protected function toTrash(string $id, string $class = null): void
    {
        $this->garbage[] = new class($id, $class ?? $this->getEntityClass()) {
            private string $class;
            private string $id;

            public function __construct(string $id, string $class)
            {
                $this->id    = $id;
                $this->class = $class;
            }

            public function getClass(): string
            {
                return $this->class;
            }

            public function getId(): string
            {
                return $this->id;
            }
        };
    }

    abstract protected function getEntityClass(): string;

    /**
     * @param string $class
     * @param int    $id
     *
     * @throws \Doctrine\ORM\ORMException
     */
    private function rm(string $class, int $id): void
    {
        $obj = $this->em->getReference($class, $id);
        $this->em->remove($obj);
        $this->em->flush();
    }
}
