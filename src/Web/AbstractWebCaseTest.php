<?php

namespace Evrinoma\TestUtilsBundle\Web;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Evrinoma\TestUtilsBundle\Helper\AbstractSymfony;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

/**
 * AbstractWebCaseTest.
 */
abstract class AbstractWebCaseTest extends WebTestCase
{
//region SECTION: Fields
    protected const API_GET      = '';
    protected const API_CRITERIA = '';
    protected const API_DELETE   = '';
    protected const API_PUT      = '';
    protected const API_POST     = '';
    protected static array $default = [];
    /**
     * @var AbstractBrowser|null
     */
    protected ?AbstractBrowser $client = null;
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;
//endregion Fields

//region SECTION: Protected
    abstract protected static function getDtoClass(): string;

    abstract protected static function defaultData(): array;

    abstract protected function setUrl(): void;

    protected function createAuthenticatedClient()
    {
        if ($this->client){
            return $this->client;
        }

        if (static::$booted) {
            $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;;
            $this->client = $container->get('test.client');
        } else {
            $this->client = static::createClient();
        }

        return $this->client;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->purgeSchema();
    }

    protected function setUp(): void
    {
        $this->client = $this->createAuthenticatedClient();

        $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;;

        $this->entityManager = $container->get('doctrine')->getManager();

        $schemaTool = $this->dropSchema($metadata);

        $schemaTool->createSchema($metadata);

        static::$default = static::defaultData();

        $this->setUrl();

        $loader = $container->get('doctrine.fixtures.loader');

        $this->loadFixtures($loader);
    }
//endregion Protected

//region SECTION: Public
    public static function merge(array $base = [], array $extend = []): array
    {
        return array_merge(unserialize(serialize($base)), $extend);
    }
//endregion Public

//region SECTION: Private
    private function loadFixtures(ContainerAwareLoader $loader): void
    {
        $groups = static::getFixtures();
        if (count($groups)) {
            $fixtures = $loader->getFixtures($groups);
            if (count($fixtures)) {
                $purger   = new ORMPurger($this->entityManager);
                $executor = new ORMExecutor($this->entityManager, $purger);
                $executor->execute($fixtures);
            }
        }
    }

    private function dropSchema(&$metadata = []): SchemaTool
    {
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata   = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->dropSchema($metadata);

        return $schemaTool;
    }

    private function purgeSchema()
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $purger->purge();
    }
//endregion Private

//region SECTION: Getters/Setters
    public static function getDefault(array $extend = []): array
    {
        return static::merge(static::$default, $extend);
    }

    abstract public static function getFixtures(): array;
//endregion Getters/Setters
}
