<?php

namespace Evrinoma\TestUtilsBundle\Web;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
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
    public static function getDefault(array $extend = []): array
    {
        return array_merge(unserialize(serialize(static::$default)), $extend);
    }

    abstract protected static function getDtoClass(): string;

    abstract protected static function defaultData(): array;

    abstract protected function setUrl(): void;

    abstract public static function getFixtures(): array;

    protected function createAuthenticatedClient($token = null)
    {
        if (null === $this->client) {
            $this->client = static::createClient();
        }

        return $this->client;
    }
//endregion Protected

//region SECTION: Public
    public function tearDown(): void
    {
        parent::tearDown();

        $this->purgeSchema();
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
    final public function setUp(): void
    {
        $this->client = $this->createAuthenticatedClient();

        $container = $this->getContainer();

        $this->entityManager = $container->get('doctrine')->getManager();

        $schemaTool = $this->dropSchema($metadata);

        $schemaTool->createSchema($metadata);

        static::$default = static::defaultData();

        $this->setUrl();

        $loader = $container->get('doctrine.fixtures.loader');

        $this->loadFixtures($loader);
    }
//endregion Getters/Setters
}
