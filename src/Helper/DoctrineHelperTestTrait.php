<?php

namespace Evrinoma\TestUtilsBundle\Helper;

use Doctrine\ORM\EntityManagerInterface;

trait DoctrineHelperTestTrait
{
//region SECTION: Fields
    private EntityManagerInterface $em;

    /**
     * Мусор, образующийся при выполнении очередного теста, который надо удалить перед выполнением следующего теста
     */
    private array $garbage = [];
//endregion Fields

//region SECTION: Protected

    protected function setEntityManager()
    {
        $this->em = static::$container->get('doctrine.orm.default_entity_manager');
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     *
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
    protected function toTrash(string $id, ?string $class = null): void
    {
        $this->garbage[] = new class ($id, $class ?? $this->getEntityClass()) {
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
//endregion Protected

//region SECTION: Private
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
//endregion Private
}