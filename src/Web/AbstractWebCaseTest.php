<?php

namespace Evrinoma\TestUtilsBundle\Web;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

/**
 * AbstractWebCaseTest.
 */
abstract class AbstractWebCaseTest extends WebTestCase
{
    protected const API_GET      = '';
    protected const API_CRITERIA = '';
    protected const API_DELETE   = '';
    protected const API_PUT      = '';
    protected const API_POST     = '';

//region SECTION: Fields
    /**
     * @var AbstractBrowser|null
     */
    protected ?AbstractBrowser $client = null;
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    protected array $default = [];
//endregion Fields

//region SECTION: Protected
    protected function getDefault(array $extend = []): array
    {
        return array_merge(unserialize(serialize($this->default)), $extend);
    }

    abstract protected static function getDtoClass(): string;

    abstract protected static function defaultData(): array;

    abstract protected function setUrl(): void;

    protected function createAuthenticatedClient($token = null)
    {
        if (null === $this->client) {
            $this->client = static::createClient();
        }

        return $this->client;
    }

    protected function load(Fixture $fixture): void
    {
        $fixture->load($this->entityManager);
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
    public function setUp(): void
    {
        $this->client = $this->createAuthenticatedClient();

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        $schemaTool = $this->dropSchema($metadata);

        $schemaTool->createSchema($metadata);

        $this->default = static::defaultData();

        $this->setUrl();
    }
//endregion Getters/Setters
}
